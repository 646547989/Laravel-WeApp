layui.use('layer', function(){
var layer = layui.layer;

@if ($errors->has('email'))
    layer.msg('{{ $errors->first('email') }}', {icon: 5});
@endif
@if ($errors->has('password'))
    layer.msg('{{ $errors->first('password') }}', {icon: 5});
@endif
});