<footer id="ddd" class="main-footer">
  <strong>Copyright &copy; 2020-2021 <a href="#">OCEI</a>.</strong>
  All rights reserved. 
  @if(session('role') =='visitor')
   <small class="badge badge-warning"><a href="{{asset('documents/user_manual_visitor.pdf')}}" rel="noopener" target="_blank"><i class="fas fa-download"></i> Download User Manual</a></small>
  @else
   <small class="badge badge-warning"><a href="{{asset('documents/user_Office.pdf')}}" rel="noopener" target="_blank"><i class="fas fa-download"></i> Download User Manual</a></small>
  @endif
  <div class="float-right d-none d-sm-inline-block">  </div>
</footer>
