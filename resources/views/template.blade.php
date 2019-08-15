@include('includes.header')    
        <!-- Page Wrapper -->
        <div id="wrapper">        
            @include('includes.side-bar')                  
                <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">                  
                <!-- Main Content -->
                <div id="content">
                    @include('includes.top-bar') 
                    <div class="container-fluid">                                                  
                        @yield('content')  
                    </div>   
                </div>
                
            @include('includes.footer-body')            
            </div>
            <!-- End of Content Wrapper -->            
        </div>
        <!-- End of Page Wrapper -->
        @include('includes.log-out-modal')    
      
@include('includes.footer')    