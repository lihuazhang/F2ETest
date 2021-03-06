<?php
    require("../server/API/common.php");
?>
<!DOCTYPE HTML>
<html >
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="assets/lib/bootstrap/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="assets/index.css" type="text/css">
    <script type="text/javascript" src="assets/lib/require.js" data-main="assets/index.js"></script>
    <title>F2E 自动化页面测试</title>
</head>
<body>
<?php $pageName = 'index'; include "common/nav.php"; ?>
<div id="content" class="container">
        <div id="main" class="">
            <div class="alert alert-info" id="index-intro">
                <a class="close" data-dismiss="alert" href="#">&times;</a>
                <?php include "docs/indexIntro.php"; ?>
            </div>
            <div id="input-wrap" class="span11">

                    <div id="script-wrap" class=""><?=reloadCode($_GET['testFile'])?></div>
                <div class="row">
                    <div class="span7 browser-info">
                        <div id="browsers" class="span6 btn-group" data-toggle="buttons-checkbox">
                            <button class="browser btn" data-loading-text="chrome" data-type="chrome">chrome</button>
                            <button class="browser btn" data-loading-text="firefox 7" data-type="firefox">firefox 7</button>
                            <button class="browser btn" data-loading-text="opera 11" data-type="opera">opera 11</button>
                            <button class="browser btn" data-loading-text="ie6" data-type="ie6">ie6</button>
                            <button class="browser btn" data-loading-text="ie7" data-type="ie7">ie7</button>
                            <button class="browser btn" data-loading-text="ie8" data-type="ie8">ie8</button>
                            <button class="browser btn" data-loading-text="ie9" data-type="ie9">ie9</button>
                            <button class="browser btn" data-loading-text="ie10" data-type="ie10">ie10</button>
                        </div>
                        <span class="browser-stat-refresh btn btn-info"><i class="icon-refresh icon-white"></i></span>
                    </div>

                    <p id="run-btn-wrap" class="offset1 span3">
                        <a class="btn btn-large" id="view-jobs-btn" href="#viewJobsModal" >查看全部任务</a>
                        <input id="run-test-btn" type="button" class="btn btn-primary btn-large" value="立即测试" />
                    </p>
                </div>
                <div class="input-error alert span10">
                </div>

            </div>
            <div id="output-wrap" class="span11">
                <div class="log-filter-list">
                    <span class="label log-filter" data-type="command" data-label="label-info">command</span>
                    <span class="label log-filter" data-type="data" data-label="label-warning">data</span>
                    <span class="label log-filter" data-type="result" data-label="label-success">result</span>
                    <span class="label log-filter" data-type="error" data-label="label-important">error</span>
                    <span class="label log-filter" data-type="screenshotSave" data-label="label-inverse">screenshotSave</span>
                    <span class="label log-filter" data-type="custom" data-label="label-custom">custom</span>
                </div>
                <div id="output-tabs" class="tabbable">
                    <ul class="hd nav nav-tabs">
<!--                        <li class=""><a href="#tab1" data-toggle="tab">session 1</a></li>-->

                    </ul>
                    <div class="bd tab-content">
<!--                        <div class="tab-pane" id="tab1">tab1 content</div>-->

                    </div>
                </div>
            </div>
        </div>
        <div id="footer"></div>
        <div class="modal fade hide" id="addEmailModal">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h3>添加本测试到定时任务</h3>
            </div>
            <div class="modal-body">
                <p>每天凌晨会将结果发送到您的邮箱，多个请用,隔开</p>
                <div class="input-prepend">
                    <span class="add-on" style="margin-bottom: 9px;"><i class="icon-pencil"></i></span><input class="span2" id="job-title" placeholder="任务标题" type="text">
                </div>
                <div class="input-prepend">
                    <span class="add-on" style="margin-bottom: 9px;"><i class="icon-envelope"></i></span><input class="span2" id="job-emails" placeholder="Email" type="text">
                </div>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn" data-dismiss="modal">关闭</a>
                <a href="#" id="add-email-btn" class="btn btn-primary">确定</a>
            </div>
        </div>
        <div class="modal fade hide" id="viewJobsModal">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h3>任务列表</h3>
            </div>
            <div class="modal-body">
                <table class="table table-condensed">
                    <thead>
                    <tr>
                        <th>标题</th>
                        <th>邮箱</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>任务标题</td>
                        <td>xixia.sm@taobao.com,xixia.sm@taobao.com</td>
                        <td>
                            <a href="#" class="btn btn-mini" target="_blank">查看</a>
                            <a href="#" class="btn btn-mini btn-danger" target="_blank">删除</a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-primary" data-dismiss="modal">关闭</a>
            </div>
        </div>
    </div>

    <script type="text/html" id="test-info-pane-tpl">

        <div class="tab-pane test-info-pane <% if( defaultActive ){ %>active<% } %>" data-type="<%=type%>" id="tab-pane-<%=type%>">
<!--            若测试结果正常-->
            <% if( result === true ) { %>

            <!-- 测试结果容器 -->
            <div id="test-result-wrap">
                <div class="test-summary title alert alert-warning">
                    <% var summary = testResult.summary; if( summary ){ %>
                    <h3>测试统计：Suite: <%=summary.suite%>, Spec: <%=summary.spec%>, Assert: <%=summary.item%>, <% if( summary.suiteFailure > 0 ){ %> <span class="alert alert-error">Suite-Failure: <%=summary.suiteFailure%>, Spec-Failure: <%=summary.specFailure%>, Assert-Failure: <%=summary.itemFailure%></span> <% } %></h3>
                    <% } else { %>
                    <h3>测试代码中未包含任何Suite</h3>
                    <% } %>
                </div>
                <ul id="test-suite-list" class="test-suite-list"></ul>
            </div>
            <hr>

            <!--测试log-->
            <ul class="test-info-logs ">
                <% for( var i = 0, log; log = logs[ i ]; i++ ){ %>
                    <li class="test-info-log log-item log-type-<%=log.type%>" >
                        <span class="log-type label <% switch( log.type ){
                            case 'command':
                                print( 'label-info' );
                                break;
                            case 'data':
                                print( 'label-warning');
                                break;
                            case 'result':
                                print( 'label-success' );
                                break;
                            case 'error':
                                print( 'label-important' );
                                break;
                            case 'screenshotSave':
                                print( 'label-inverse');
                                break;
                            case 'custom':
                                print( 'label-custom' );
                                break;
                        }
                        %>"><%=log.type%></span>
                           <span class="log-text"><% print(log.msg); if( log.screenshot ){ %>--- <a target="_blank" href="<%=log.screenshot%>">屏幕截图</a> <% } %></span>

                    </li>
                <% } %>
            </ul>


            <% } else { %>
            <!--若错误，则显示错误信息-->
            <div><div class="alert alert-error">测试出错啦！错误信息：<%=error%></div></div>
            <% } %>
            <div class="test-screenshot"><img src="<%=screenshot%>"></div>
        </div>
    </script>

    <script type="text/html" id="test-info-trigger-tpl">
        <li data-type="<%=type%>" class="test-info-trigger <% if( defaultActive ){ %>active<% } %>"><a href="#tab-pane-<%=type%>" data-toggle="tab"><%=type%></a></li>
    </script>

<!--    解释结果suite单元模板-->
    <script type="text/html" id="test-result-suite-tpl">

<!--        遍历所有的suite-->
        <% for( var i = 0, suite; suite = testResult[ i ]; i++ ){ %>
<!--        根据测试结果是否完全通过 1、显示的颜色 2、是否折叠-->
        <li class="test-suite-item alert <% if( suite.result === true ){ print( 'alert-info fold' ); } else { print( 'alert-error' ); } %>">
            <div class="hd suite-title title">
                <h4><%=suite.description%></h4>
                <i class="<% if( suite.result === true ){ print( 'icon-plus' ); } else { print( 'icon-minus' ); } %>"></i>
            </div>
            <ul class="test-spec-list">

<!--                遍历所有的spec-->
                <% for( var j = 0, spec; spec = suite.specs[ j ]; j++ ){ %>
                <!--        根据测试结果是否完全通过 1、显示的颜色 2、是否折叠-->
                <li class="test-spec-item alert <% if( spec.result === true ){ print( 'alert-success  fold' ); } else { print( 'alert-error' ); } %>">
                    <div class="hd spec-title title">
                        <h5><%=spec.description%></h5>
                        <i class="<% if( spec.result === true ){ print( 'icon-plus' ); } else { print( 'icon-minus' ); } %>"></i>
                    </div>
                    <ul class="test-assert-list">
                        <% for( var k = 0; item = spec.items[ k ]; k++ ){ %>
                        <li class="test-item alert <% if( item.result === true ){ print( 'alert-success' ); } else { print( 'alert-error' ); } %>">
                            <i class="<% if( item.result ){ print( 'icon-ok' ); } else { print( 'icon-remove' ); } %>"></i>
                            <span class="received"><% print( String( item.received ) ); %> </span>
                            <span class="operation label label-inverse"><% if( item.ifNot ){ print( 'not' ); } %> <%=item.operation%></span>
                            <span class="expected"><% print( String( item.expected ) ); %></span>
                        </li>
                        <% } %>
                    </ul>
                </li>
                <% } %>
            </ul>

<!--            若存在子suite-->
            <% if( suite.suites.length > 0 ){ %>
<!--            下面的字符串为子suite被渲染完成后，用于替换的标识-->
            <ul class="test-suite-list">
                ##test-suite-list-tag-<%=i%>##
            </ul>
            <% } %>
        </li>
        <% } %>
    </script>
</body>
</html>