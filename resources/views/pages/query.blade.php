@extends('../layout')

@section('title', 'Query')

@section('head')
<link rel="stylesheet" href="{{ url('css/pages/query.css') }}">
<script src="{{ url('/js/pages/query.js') }}"></script>
@endsection

@section('content')
<h2>Search and discover</h2>
<p>This tool allows you to conduct research and find information normally you woulnd'nt be able to. In order to query data you need to construct SQL like statement and execute it. Below you can learn more by exploring examples and try it yourself.</p>
<h2>Examples</h2>
<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae illum culpa blanditiis porro est eaque nobis quas ab accusamus quia, quaerat incidunt doloribus fugiat nulla commodi dolorum? Aperiam libero tempora, magni laborum fugit ea quo enim ut corrupti minima culpa. Cupiditate quo saepe impedit hic. Tenetur facilis natus fuga, quaerat deleniti eos saepe nam temporibus? Amet quasi vel animi maxime enim quae, deleniti placeat voluptatibus officia provident obcaecati blanditiis illum error laborum doloribus modi inventore nesciunt! Possimus saepe, dolorum tempora rerum voluptatem reiciendis optio blanditiis illo! Esse modi officia voluptatum harum, corporis corrupti sint recusandae natus dicta provident autem excepturi.</p>
<h2>Execute</h2>
<p>Enter your query below and hit enter to execute it.</p>
<input id="query-input" type="text" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
<table id="query-output">
</table>
@endsection