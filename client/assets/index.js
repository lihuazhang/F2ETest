(function(){

    var API = {

        BROWSER_STAT: 'http://localhost:8888/f2e-webDriver/fake/stat.php',
        REQUEST_TEST: 'TEST'
    };

    $( document).ready(function (){

        var Main = new Views.Main({
            el: $( '#content' )
        });
        window[ 'main' ] = Main;

    });

    /*== util ==*/
    var command = {

        getBrowserStat: function ( next ){

            $.get( API.BROWSER_STAT, function ( data ){

                next( data );
            }, 'json' );

        },
        requestTest: function ( data, next ){

            $.post( API.REQUEST_TEST, data, next, 'json' );
        }
    };

    /*== views ==*/
    var Views = {

        Main: Backbone.View.extend({

            initialize: function (){

//                this.el = $( '#content' );
                this.browserListEl = $( '#browsers' );
                this.codeTextarea = $( '#testcode-area' );
                this.model = new Models.TestInfo();
                this.TestInfo = new Views.TestInfo();

//                this.codeTextarea.on( 'change', this.onTestcodeChange );

                this.attachModel();
            },

            events: {
                'change #testcode-area': 'onTestcodeChange',
                'click #browsers input[type=checkbox]': 'onRequestBrowsersChange'
            },

//            render: function (){
//
//            },

            /**
             * 绑定model事件
             */
            attachModel: function (){

                var that = this;

                this.model.on( 'change:availableBrowser', function ( m, name ){

                    that.updateBrowserList();
                });
            },

            /**
             * 根据当前model.available的值，来更新浏览器选择列表
             */
            updateBrowserList: function (){

                var availableBrowser = this.model.get( 'availableBrowser' );
                var that = this;

                this.browserListEl.find( '.browser').each(function (){

                    if( _.indexOf( availableBrowser, $( this ).attr( 'data-type' ) ) >= 0 ){

                        that.toggleBrowserStat( this, true );
                    }
                    else {

                        that.toggleBrowserStat( this, false );
                    }
                });

//                console.log( 'test');
            },

            /**
             * 修改浏览器选择部分是否为可用状态
             * @param type
             * @param ifAble
             */
            toggleBrowserStat: function ( type, ifAble ){


                var browserSpan = $( typeof type === 'string' ? this.browserListEl.find( '.browser[data-type=' + type + ']') : type );

                if( ifAble ){

                    browserSpan.removeClass( 'unavailable' );
                    browserSpan.find( 'input').removeAttr( 'disabled' );
                }
                else {

                    browserSpan.addClass( 'unavailable' );
                    browserSpan.find( 'input').attr( 'disabled', 'disabled' );
                }

            },


            runTest: function (){

                var data = this.model.toJSON();
                var requestBrowser = data.requestBrowser;
                var testCode = data.code;
                var that = this;

                _.each( requestBrowser, function ( browser ){

                    that.TestInfo.addItem( {
                        testCode: testCode,
                        type: browser
                    });
                });

            },

            /**
             * 当测试代码发生变化
             */
            onTestcodeChange: function (){

                this.model.set({
                    testcode: this.codeTextarea.val()
                });

                console.log( 'test' );
                console.log( this.model.get( 'testcode' ) );
            },

            /**
             * 当浏览器选择发生变化
             */
            onRequestBrowsersChange: function (){

                var checkboxes = this.browserListEl.find( 'input[type=checkbox]' );
                var requestBrowsers = [];

                $( checkboxes).each(function (){

                    var checkbox = $( this );
                    var name;

                    if( checkbox.prop( 'checked' ) ){

                        name = checkbox.parent().attr( 'data-type' );

                        requestBrowsers.push( name );
                    }
                });

//                console.log( availableBrowsers );

                this.model.set({
                    requestBrowser: requestBrowsers
                });

            }
        }),

        TestInfo: Backbone.View.extend({

            initialize: function (){

                this.testInfoList = [];
            },

            events: {

            },

            addItem: function ( data ){

                this.testInfoList[ data.type ] = new Views.TestInfoItem({
                    data: data
                });
            },

            removeItem: function ( type ){

                this.testInfoList[ type ].remove();
            },

            clear: function (){

                _.each( this.testInfoList, function ( item ){

                    item.remove();
                });
            }
        }),

        TestInfoItem: Backbone.View.extend({

            initialize: function (){

                this.parentEl = $( '#output-tabs' );
                this.model = new Models.TestInfoItem( this.data );

            },

            events: {

            },

            attachModel: function (){

                var that = this;

                this.model( 'change', function (){

                    that.render();
                });
            },

            render: function (){

            },

            remove: function (){

                this.model.destroy();
                this.el.remove();
            }
        })
    };


    /*== models ==*/
    var Models = {

        TestInfo: Backbone.Model.extend({

            initialize: function (){

                this.getBrowserStat();
            },

            defaults: {
                ifCheckStat: false,
                testCode: '',
                availableBrowser: [],
                isTesting: false,
                requestBrowser: [],
                finishedBrowser: []
            },

            getBrowserStat: function (){

                var that = this;

                command.getBrowserStat(function ( data ){

                    data = that.statDataHanele( data );

                    that.set({
                        ifCheckStat: true,
                        availableBrowser: data
                    });
                });
            },

            statDataHanele: function ( data ){

                var dataHandled = [];

                _.each( data, function ( item ){

                    dataHandled.push( item.type );
                });

                return dataHandled;
            }
        }),

        TestInfoItem: Backbone.Model.extend({

            initialize: function (){

                var data = this.toJSON();

                command.requestTest( data,function (){


                });

            },

            defaults: {
                stat: 'testing', // testing | finished | error
                testCode: '',
                screenshot: '',
                output: '',
                type: 'browser'
            }
        })
    }

})();
