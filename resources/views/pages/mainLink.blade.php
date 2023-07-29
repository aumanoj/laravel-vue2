<!-- footer main link pages -->
@extends('layouts/unlock')



@section('head')

<title>{{$pages->title}}</title>
<meta name="description" content="<?php echo $pages->meta_keyword ?>" />
<meta name="keywords" content="<?php echo $pages->meta_description ?>" />
<style>
  div#brand-errors,
  #model-errors {
    padding: 6px 0;
    color: #fa755a;
    font-weight: 600;
  }
</style>
@if($pages->alias == 'faqs')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [{
    "@type": "Question",
    "name": "What is the reason behind my phone’s lock?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "The SIM lock on your mobile handset is being imposed by the GSM network providers in order to prevent you from using the phone outside their complex. When you purchase a GSM mobile phone at a subsidized price along with subscriptions to a particular network, the operators usually set a target to get back this investment before you terminate the service. In order to get back investment, the network providers implement this feature called SIM lock on your mobile."
    }
  },{
    "@type": "Question",
    "name": "What is SIM Lock Mean?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "This is a typical feature of software found in GSM phones which is made by the manufacturers. This feature is being used by the service providers or network providers to impose restrictions on the use of the phone in specific countries and particular network providers."
    }
  },{
    "@type": "Question",
    "name": "What does Unlock Code mean?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "An unlock code is a numeric function which is entered into a locked mobile handset. The unlock code deactivates the SIM lock and makes the mobile capable of using other GSM carriers."
    }
  },{
    "@type": "Question",
    "name": "How do I locate my IMEI number?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "The most common way of finding the IMEI number of your handset is by entering *#06# or by locating it below the battery of your phone. If you still can't find it, please follow the steps mentioned below based on your handset type.
For Android - Click \"Settings\" and click on \"About Phone\"
For iOS - Open \"Settings\", click \"General\" and then click \"About\"
For Blackberry - Click on \"Options\" and then select \"Status\"
For Sony Ericcson - Open \"Options\" and then select \"Status\""
    }
  },{
    "@type": "Question",
    "name": "What are the end results of Unlocking?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "The unlock code will remove the SIM lock from your original handset, thus making it usable on other GSM networks."
    }
  },{
    "@type": "Question",
    "name": "What are the things that unlocking can't do?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "Unlocking cannot remove the ban caused due to your lost or stolen phone. It does not give free services to the customer, nor does it delete user passwords from your SIM or mobile handset. It never provides you with frequency bands on CDMA/IDEN networks for your usage. Finally, it does not void the warranty of your cellphone."
    }
  },{
    "@type": "Question",
    "name": "Is it possible to use the original network after I have implemented the unlocking process?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "Yes you can always use your original network even after the unlock process is done."
    }
  },{
    "@type": "Question",
    "name": "Is the unlocking done permanently?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "Definitely yes; once we unlock your phone, it will always remain unlocked forever."
    }
  },{
    "@type": "Question",
    "name": "Can a software update on my phone lock it again?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "No, the chances are very less. OS updates generally don't lock your phone. However, in rare cases of the phone getting locked again, you can always re-use the lock code you purchased from us to unlock it again."
    }
  },{
    "@type": "Question",
    "name": "Is there any expiry date for my unlocking code?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "No, the unlock codes we provide are permanent and have no expiry date."
    }
  },{
    "@type": "Question",
    "name": "Will repairs lock my phone?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "It actually depends on the degree of repairing that is carried out on your phone. If the main board is replaced with a new one, it will then have a new IMEI number that is different from the earlier one. Thus, a new unlock code will be required for the new IMEI number. But if the main board is just repaired and not replaced, the phone will normally be in unlocked state as before. However, in the event of unlocking by any means, you can always re-use the original unlocking code purchased from us."
    }
  },{
    "@type": "Question",
    "name": "Why some unlock codes are expensive as compared to others?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "The cost of the unlock codes depends on the source which they are obtained from. In most cases, when the code is obtained from the manufacturer, it becomes more expensive. In other cases where the unlock codes are released by the network providers based on the age of the handset or other requirements of the customer, the price becomes low. However, the network providers do not always release the codes due to eligibility requirements, sales arrangements, etc. In these cases, the unlock codes can be obtained through manufacturers only."
    }
  },{
    "@type": "Question",
    "name": "What is the meaning of PUK code?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "PUK or PIN Unlock Key is needed to unlock your SIM card in the event that it has been locked after entering incorrect PIN for three consecutive times. If you enter wrong PUK for consecutive 10 times, then your SIM card will become invalid and you will be required to purchase a new one."
    }
  },{
    "@type": "Question",
    "name": "What do you mean by hard lock of your phone?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "Hard lock means your mobile phone gets permanently locked when you enter wrong SIM unlock code for greater number of times than what your phone actually permits. The number of attempts that can be made before it is hard locked depends on the mobile phone manufacturer and varies from one device to another. Usually, the number of attempts for Samsung, Nokia, Motorola, and HTC is 5 while for Blackberry and LG it is 10."
    }
  },{
    "@type": "Question",
    "name": "What is the difference between manufacturers' and networks' unlock methods?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "The network unlock codes are the codes which are directly obtained from the network provider , while the manufacturer unlock codes are acquired from the company which manufactured the handset like Samsung, Nokia, etc. The network codes are cheaper as compared to manufacturer's code which is little expensive. However, the delivery rate and efficiency of the manufacturer code is higher as it successfully delivers 95% of all the orders. The accuracy rate of the network codes is only 75% which is quite low when compared to that of manufacturers'."
    }
  }]
}
</script>

@endif
@endsection

@section('content')
@include('layouts.header')

<section id="aboutsection">
  <div class="container mt-5">
  <div class="row">
  <div class="col-md-12 col-sm-8">
    <h2 class="main-head-1 uppercase lightGreen mt50 mb30 heading" itemprop="headline">{!! $pages->title !!}</h2>
    <span class="caret"></span>
      <div class="descriptionBox mb50" itemprop="description">
        {!! $pages->content !!}
      </div>
    </div>
  </div>
  </div>
</section>
  @include('layouts.footer')
@endsection

  @section('footer')
    
  @endsection