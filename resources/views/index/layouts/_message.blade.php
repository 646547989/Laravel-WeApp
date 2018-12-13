@if (Session::has('message'))
    layer.msg('{{ Session::get('message') }}', {icon: 6});
@endif

@if (Session::has('success'))
    layer.msg('{{ Session::get('success') }}', {icon: 6});
@endif

@if (Session::has('danger'))
    layer.msg('{{ Session::get('danger') }}', {icon: 5});
@endif