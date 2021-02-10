 <!-- Sidebar  -->
 <nav id="sidebar">
     <div class="user-panel">
         <div class="image">
             <img src="{{Auth::user()->profile_picture_url}}" class="rounded-circle" alt="User Image">
         </div>
         <div class="info">
             <p>{{Auth::user()->full_name}}</p>
             <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
         </div>
     </div>
     @if(!Auth::user() || empty(Auth::user()->lastSubscriptionDetail))
     <a href="#" class="free-trial">Sign Up Free Trial</a>
     @endif

     <ul class="list-unstyled components">

         <li>
             <a href="{{route('front.account-information')}}"><span><img src="{{asset('public/front/images/account-card-details.svg')}}"></span>Account Information</a>
         </li>
         <li class="">
             <a href="{{route('front.subscription-payment')}}"><span><img src="{{asset('public/front/images/payment.svg')}}"></span>Subscription & Payment</a>
         </li>
         <li>
             <a href="{{route('front.get-general-settings')}}"><span><img src="{{asset('public/front/images/settings.svg')}}"></span>Settings</a>
         </li>
         <li>
             <a href="#"><span><img src="{{asset('public/front/images/integrations.svg')}}"></span>Integrations</a>
         </li>
         <li>
             <a href="{{route('front.get-personal-information')}}"><span><img src="{{asset('public/front/images/user-circle.svg')}}"></span>Personal Information</a>
         </li>
         <li>
             <a href="#"><span><img src="{{asset('public/front/images/audit-trial.svg')}}"></span>Audit Trail</a>
         </li>
         <li>
             <a href="{{route('front.get-custom-branding')}}"><span><img src="{{asset('public/front/images/custom-branding.svg')}}"></span>Custom Branding</a>
         </li>
         <li>
             <a href="{{ route('front.address-book-list') }}"><span><img src="{{asset('public/front/images/address-book.svg')}}"></span>Address Book</a>
         </li>
         <li>
             <a href="#"><span><img src="{{asset('public/front/images/api.svg')}}"></span>API</a>
         </li>
     </ul>

     <!-- <ul class="list-unstyled CTAs">
                <li>
                    <a href="#" class="download">Download source</a>
                </li>
                <li>
                    <a href="https://bootstrapious.com/p/bootstrap-sidebar" class="article">Back to article</a>
                </li>
            </ul> -->
 </nav>