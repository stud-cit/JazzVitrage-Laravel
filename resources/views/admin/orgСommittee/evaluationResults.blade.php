@extends('layouts.admin.index')

@section('content')

    <form role="form">
        {{-- Временное решение --}}
        <div style="margin-bottom: -35px;margin-left: 10px; font-size: 24px;"><i class="fa fa-search" aria-hidden="true"></i></div>
        <input style="padding-left: 40px;" type="text" class="form-control">
    </form>
  <br>
    <div class="row">
        <div class="col-sm">
            <label for="documentType">Тип документу</label>
            <select class="form-control" id="documentType">
                <option>хз</option>
                <option>хз хз</option>
                <option>хз хз хз</option>
            </select>
        </div>
        <div class="col-sm">
                <label for="member">Учасник (тип)</label>
                <select class="form-control" id="member">
                    <option>Соліст</option>
                    <option>Дует</option>
                    <option>Група</option>
                </select>
        </div>
        <div class="col-sm align-self-center">
            <div class="row justify-content-center">
                <button type="button" class="btn btn-outline-secondary">Згенерувати документ</button>
            </div>
        </div>
    </div>

  <br>
    <table class="table table-bordered">
        <thead>
              <tr>
              <th>Example</th>
              <th>Example</th>
              <th>Example</th>
              </tr>
        </thead>
        <tbody>
              <tr>
              <td>Example</td>
              <td>Example</td>
              <td>Example</td>
              </tr>
        </tbody>
    </table>

@endsection
