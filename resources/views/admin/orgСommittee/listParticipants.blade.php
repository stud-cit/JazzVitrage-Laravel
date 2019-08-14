@extends('layouts.admin.index')

@section('content')

      <form role="form">
            <div style="margin-bottom: -35px;margin-left: 10px; font-size: 24px;"><i class="fa fa-search" aria-hidden="true"></i></div>
            <input style="padding-left: 40px;" type="text" class="form-control">
      </form>
      <br>
      <table class="table table-bordered">
      <thead>
            <tr>
            <th>Example</th>
            <th>Example</th>
            <th>Example</th>
            <th width="30px"></th>
            </tr>
      </thead>
      <tbody>
            <tr>
            <td>Example</td>
            <td>Example</td>
            <td>Example</td>
            <td><a href="#"><i class="fa fa-times" aria-hidden="true"></i></a></td>
            </tr>
      </tbody>
      </table>

@endsection
