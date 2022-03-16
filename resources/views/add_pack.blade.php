@extends('layout')
 @section('container')
                        <div class="row m-t-30">
                            <div class="col-md-12">
                        <a href="{{url('pack')}}"> <button type="button"  class="btn btn-success mb-3">Back</button></a>
                                <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">Add Pack</div>
                                    <div class="card-body">
                                       
                                        <form action="{{route('pack.insert')}}" method="post" enctype="multipart/form-data" >
                                            @csrf
                                            <input type="hidden" name="pack_id" id="pack_id" value="{{$result['id']}}">
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Pack Size</label>
                                                <input id="pack_size" name="pack_size" type="text" class="form-control" value="{{$result['pack_size']}}" aria-required="true" aria-invalid="false">
                                          
                                          <br>
                                             @error('pack_size')
                                          <div class="alert alert-danger" role="alert"> {{$message}}</div>
                                            @enderror
                                            </div>
                                            
                                            

                                            <div>
                                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                                  
                                                    <span id="payment-button-amount">Add</span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                                
                                </div>
                                <!-- END DATA TABLE-->
                            </div>
                     
 @endsection

