@extends('../layout')

@section('title', 'Query')

@section('head')
<link rel="stylesheet" href="{{ url('css/pages/query.css') }}">
<script src="{{ url('/js/pages/query.js') }}"></script>
@endsection

@section('content')
<h2>Search and discover</h2>
<p>This tool allows you to conduct research and find information normally you woulnd'nt be able to. In order to query data you need to construct SQL like statement and execute it.</p>

<h2>Examples</h2>
<p>Show all tables available</p>
<code>show tables</code>
<p>Show all columns in table</p>
<code>show columns from people</code>
<p>Select properties from table</p>
<code>select name, population from planets</code>
<p>Joining tables</p>
<code>select character.name, character.mass, planet.name as homeworld from people character inner join planets planet on character.homeworld = planet.id</code>

<h2>Execute</h2>
<p>Enter your query below and hit enter to execute it.</p>
<div class="overflow-wrapper">
    <input id="query-input" type="text" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
</div>
<table id="query-output">
</table>
@endsection