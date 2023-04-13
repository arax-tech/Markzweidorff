@extends('user.layouts.app')

@section('title', 'Documents Status')

@section('content')
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-fluid px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="file"></i></div>
                            Documents Status
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-fluid px-4">


        <div class="row">
            <div class="col-xl-12">
                <!-- Account details card-->
                <div class="card mb-4">
                    <div class="card-header">Documents Status</div>
                    <div class="card-body">
                        <table class="table table-striped table-hover" id="example">
                            <thead>
                                <tr>
                                    <th>S#</th>
                                    <th>User</th>
                                    <th>Document Title</th>
                                    <th>SubTitle</th>
                                    <th>Statue</th>
                                    <th>Action Time</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                @foreach ($documents as $key => $document)
                                    <tr>
                                        @php
                                            error_reporting(0);
                                            $doc = DB::table('documents')->where('id', $document->document_id)->first();
                                            $user = DB::table('users')->where('id', $document->user_id)->first();
                                        @endphp

                                        
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $user->name }} </td>
                                        
                                    
                                        <td>{{ mb_strimwidth($doc->title, 0, 40, "...") }}</td>
                                        <td>{{ mb_strimwidth($doc->subtitle, 0, 30, "...") }}</td>
                                        <td>
                                            @if ($document->status == "Read Understood")
                                                 <span class="badge bg-success text-white rounded-pill p-1">{{ $document->status }}</span>
                                            
                                            @elseif ($document->status == "Read")
                                                 <span class="badge bg-success text-white rounded-pill p-1">{{ $document->status }}</span>

                                            @elseif ($document->status == "Read Not Understood")
                                                 <span class="badge bg-danger text-white rounded-pill p-1">{{ $document->status }}</span>
                                            @else
                                                 <span class="badge bg-secondary text-white rounded-pill p-1">{{ $document->status }}</span>
                                            @endif
                                        </td>
                                        <td>{{ date('d M Y', strtotime($document->created_at)) }}</td>

                                    </tr>







                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

