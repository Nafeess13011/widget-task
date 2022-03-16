@extends('layout')
 @section('container')
                        <div class="row m-t-30"  ng-app="project">
                            <div class="col-md-12"  ng-controller="projectinfo">
                        <a href="{{url('/')}}"> <button type="button"  class="btn btn-success mb-3">Back</button></a>
                                <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">Process Order</div>
                                    <div class="card-body">
                                       
                                        <form >
                                            @csrf
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Total Widgets Required</label>
                                                <input id="widgets" name="widgets" type="text" class="form-control" ng-model="widget['size']" aria-required="true" aria-invalid="false">
                                          
                                          <br>
                                            </div>
                                            
                                            

                                            <div>
                                                <button id="payment-button" ng-click="processorder()" type="button" class="btn btn-lg btn-info btn-block">
                                                  
                                                    <span id="payment-button-amount">Add</span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                                
                            <table class="table table-borderless table-data3">
                                        <thead>
                                            <tr>
                                                <th>Pack Size</th>
                                                <th>Count sale</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="row in displayedCollectionsale">
                                                <td>@{{row.pack_size}}</td>
                                                <td>@{{row.size}}</td>
                                            </tr>
                                    </tbody>
                                </table>
                                </div>
                                <!-- END DATA TABLE-->

                            </div>


                     
 @endsection
 @section('dynamic_js')
<script src="{{@asset('front_assets/customJS/script-processorder.js')}}"></script>
    @endsection 
