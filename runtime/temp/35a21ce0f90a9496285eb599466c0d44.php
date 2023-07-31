<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:51:"./application/admin/view2/lottery/activity_add.html";i:1532529446;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>抽奖活动 - www.ohbbs.cn 欧皇源码论坛 </title>
    <link rel="stylesheet" href="__ROOT__/public/static/lib/layui-v2.3.0/css/layui.css">
    <script src="__ROOT__/public/static/lib/layui-v2.3.0/layui.js"></script>
    <script src="__ROOT__/public/plugins/Ueditor/ueditor.config.js"></script>
    <script src="__ROOT__/public/plugins/Ueditor/ueditor.all.min.js"></script>
    <style>
        .wrap {
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="wrap">
        <form class="layui-form" action="" method="post" submit-type="ajax">
            <div class="layui-form-item">
                <label class="layui-form-label">活动标题</label>
                <div class="layui-input-block">
                    <input class="layui-input" type="text" name="title" placeholder="请输入活动标题" autocomplete="off" value="<?php echo $lottery->title; ?>">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">抽奖次数</label>
                <div class="layui-input-block">
                    <input class="layui-input" type="text" name="total_limit" placeholder="每人最高可获得抽奖次数" autocomplete="off" value="<?php echo $lottery->total_limit; ?>">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">直推奖励</label>
                <div class="layui-input-block">
                    <input class="layui-input" type="text" name="step" placeholder="每推荐一人可获得抽奖次数" autocomplete="off" value="<?php echo $lottery->step; ?>">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">活动状态</label>
                <div class="layui-input-block">
                    <input type="radio" name="status" value="1" title="启用" <?php if(!isset($lottery['status']) || $lottery['status'] ==1): ?>checked<?php endif; ?>>
                    <input type="radio" name="status" value="0" title="停用" <?php if(isset($lottery['status']) && $lottery['status'] == 0): ?>checked<?php endif; ?>>
                </div>
            </div>
            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">活动规则</label>
                <div class="layui-input-block">
                    <script id="container" name="rule_content" type="text/plain"><?php echo htmlspecialchars_decode($lottery->rule_content); ?></script>
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
                    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                </div>
            </div>
        </form>
    </div>
</body>
<script>
    var ue = UE.getEditor('container');
    layui.use(['element', 'form', 'layer', 'jquery'], function () {
        var element = layui.element, form = layui.form, layer = layui.layer, $ = layui.$;
        $('form[submit-type=ajax]').submit(function() {
            var data = $(this).serialize();
            $.ajax({
                url: '',
                type: 'POST',
                data: data,
                success: function (response) {
                    if (response.code == 1) {
                        layer.msg(response.msg, {time:2000}, function() {
                            parent.layui.table.reload('lottery', {});
                            parentIndex = parent.layer.getFrameIndex(window.name);
                            parent.layer.close(parentIndex);
                        });
                    } else {
                        layer.msg(response.msg, {anim: 6});
                    }
                }
            });
            return false;
        });
    });
</script>
</html>