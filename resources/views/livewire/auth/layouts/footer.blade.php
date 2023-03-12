 <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
 <footer class="footer py-5">
     <div class="container">
         <div class="row">
             <div class="col-lg-8 mb-4 mx-auto text-center">

             </div>
         </div>
         <div class="row">
             <div class="col-8 mx-auto text-center mt-1">
                 <p class="mb-0 text-secondary">
                   ©
                     <script>
                         document.write(new Date().getFullYear())
                     </script> <strong>Forum Alumni SMK KESEHATAN HUSADA PRATAMA. </strong> All Rights Reserved.
                     {{-- <strong> All Rights Reserved.</strong> --}}
                     <br>
                        {{-- <strong>Donate for Creator</strong> <a href="https://saweria.co/ridhosuhaebi">Ridho Suhaebi Arrowi</a> --}}
                 </p>
             </div>
         </div>
     </div>
 </footer>
 <!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
 <!--   Core JS Files   -->
 @livewireScripts
 <script src="{{ asset('assets/admin') }}/js/core/popper.min.js"></script>
 <script src="{{ asset('assets/admin') }}/js/core/bootstrap.min.js"></script>
 <script src="{{ asset('assets/admin') }}/js/plugins/perfect-scrollbar.min.js"></script>
 <script src="{{ asset('assets/admin') }}/js/plugins/smooth-scrollbar.min.js"></script>
 <script>
     var win = navigator.platform.indexOf('Win') > -1;
     if (win && document.querySelector('#sidenav-scrollbar')) {
         var options = {
             damping: '0.5'
         }
         Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
     }
 </script>
 <!-- Github buttons -->
 <script async defer src="https://buttons.github.io/buttons.js"></script>
 <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
 <script src="{{ asset('assets/admin') }}/js/soft-ui-dashboard.min.js?v=1.0.3"></script>
 @stack('scripts')
 </body>

 </html>
