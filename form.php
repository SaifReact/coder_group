   <?php include_once __DIR__ . '/includes/open.php'; ?>
   <!-- Hero Start -->
   <div class="container-fluid pb-5 hero-header bg-light">
     <div class="container">
       <div class="row justify-content-center">
         <div class="col-12 col-md-12 col-lg-12 col-xl-12">
           <div class="glass-card">
             <h5 class="text-center fw-bold mb-4" style="color:#045D5D; letter-spacing:1px; text-shadow:1px 2px 8px #fff8; font-size:1.5rem; font-family:'Poppins',sans-serif;">Member Registration Form ( সদস্য নিবন্ধন ফর্ম )</h5>
             <hr />
             <div class="mb-4">
               <h5 class="fw-bold mb-3" style="color:#008080;">Rules and Regulations (নিয়মাবলি ও বিধান)</h5>
               <ul style="font-size:1.05rem;line-height:1.7;">
                 <li>সমিতির নাম: "কোডার পেশাজীবী সমবায় সমিতি লিমিটেড" (Coder Pesajibi Samabay Samity Ltd.)</li>
                 <li>সমিতির ঠিকানা: সমিতির নিবন্ধিত অফিস হবে []।</li>
                 <li>সমিতির উদ্দেশ্য: সমিতির মূল উদ্দেশ্যসমূহ হলো: (Objective of the Society: The main objectives of the society are:)</li>
                 <li>ক) কোডার এবং আইটি পেশাজীবীদের মধ্যে সহযোগিতা বৃদ্ধি করা। (To promote cooperation among coders and IT professionals.)</li>
                 <li>খ) সদস্যদের আর্থিক, প্রযুক্তিগত ও প্রশিক্ষণ সহায়তা প্রদান। (To provide financial, technical, and training support to members.)</li>
                 <li>গ) যৌথ উদ্যোগ ও ফ্রিল্যান্সিংয়ের মাধ্যমে কর্মসংস্থানের সুযোগ সৃষ্টি। (To create employment opportunities through joint ventures and freelancing.)</li>
                 <li>ঘ) সদস্যদের আর্থসামাজিক উন্নয়ন নিশ্চিত করা। (To ensure the economic and social development of the members.)</li>
               </ul>
               <div class="form-check mt-3">
                 <input class="form-check-input" type="checkbox" value="1" id="agreeRules">
                 <label class="form-check-label" for="agreeRules"> I have read and agree to the Rules & Regulations. (আমি নিয়মাবলী পড়েছি এবং সম্মত।) </label>
               </div>
             </div>
             <div class="text-center mt-4">
               <button id="goToFormBtn" class="btn btn-success btn-lg rounded-pill px-5" style="display:none;letter-spacing:1px;">Proceed to Registration Form (নিবন্ধনটি এগিয়ে যান)</button>
             </div>
           </div>
         </div>
       </div>
     </div>
   </div>
   <!-- Hero End --> <?php include_once __DIR__ . '/includes/end.php'; ?>