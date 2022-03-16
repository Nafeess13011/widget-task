@extends('layout')
@section('banner_select','active has-sub')
 @section('container')

<div class="row m-t-30">
                            <div class="col-md-12">
                        <a href="{{url('pack/add')}}"> <button type="button"  class="btn btn-success mb-3">Add pack</button></a>
                            <br>
                            @if(session('pack_add_success')!="")

                        
                            <div class="alert alert-success" role="alert">{{@session('pack_add_success')}}
                                        </div>
                           @endif
                                <!-- DATA TABLE-->
                                <div class="table-responsive m-b-40">
                                    <table class="table table-borderless table-data3">
                                        <thead>
                                            <tr>
                                                <th>Seq no.</th>
                                                <th>Package Size</th>

                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($result as $row)
                                            <tr>
                                                <td>{{$row['seqno']}}</td>
                                                <td>{{$row['pack_size']}}</td>
                                                <td >
                                                     
                                                    <a href="{{url('pack/delete')}}/{{$row['id']}}"><button type="button" class="btn btn-danger">Delete</button></a>
                                               
                                                    <a href="{{url('pack/add')}}/{{$row['id']}}"><button type="button" class="btn btn-info">Edit</button></a>
                                                </td>
                                            </tr>
                                            @endforeach
                                            
                                        </tbody>
                                    </table>
                                </div>
                                <!-- END DATA TABLE-->
                            </div>
                        </div>



 @endsection