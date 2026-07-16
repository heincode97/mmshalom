<div class="d-none">
<?php 
  $fields = get_fields();
  $bg_type = $fields['bg_types'];
?>
<?php if($bg_type == 'bg_image') { 
  $bg_image = $fields['bg_image'];
?>
<div style="background_image: url(<?php echo $bg_image; ?>);" class="overlay-image">
  <h3><?php echo $fields['title'] ?></h3>
</div>

<?php }elseif($bg_type == 'color') { ?>
    
<?php } ?>
</div>

<!-- custom by MMM -->

<section class="tailor-made-section">
  <div class="overlay">
    <div class="content-box">
      <h4 class="tailor-title">TAILOR MADE TRAVEL</h4>
      <p>
        Seeing Myanmar exactly how you want to see it, created around your specific interests, budget and schedule on an itinerary fashioned for you by our Myanmar travel experts.
      </p>
      <a href="#" class="btn btn-primary">REQUEST YOUR TAILOR MADE JOURNEY</a>
    </div>
  </div>
</section>

<!-- About Us Nav Tabs -->
<section class="about-us-section gap-y">
  <ul class="nav nav-pills mb-7 justify-content-center" id="pills-tab" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="about-tab" data-bs-toggle="pill" data-bs-target="#about" type="button" role="tab">ABOUT US</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="story-tab" data-bs-toggle="pill" data-bs-target="#story" type="button" role="tab">OUR STORY</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="team-tab" data-bs-toggle="pill" data-bs-target="#team" type="button" role="tab">OUR TEAM</button>
    </li>
  </ul>

  <!-- Tab Content -->
  <div class="tab-content" id="pills-tabContent">
    <!-- ABOUT US TAB -->
    <div class="tab-pane fade show active" id="about" role="tabpanel">
      <div class="row align-items-center">
        <div class="col-md-5">
          <img src="/app/uploads/2025/11/5eae5a6f910d7ff97512c9b46cb5b25ef0fa3d03.jpg" class="about-img" alt="About us image">
        </div>
        <div class="col-md-7">
          <div class="about-text">
            <p>Our Story: The Shalom story began back in 2006 while Sammy Samuels, founder of the company, was studying at Yeshiva University in New York. Even when Myanmar was a pariah state, Moses Samuels, Sammy’s father, had long helped tourists interested in visiting the country, answering their queries regarding accommodations, flights and restaurants.</p>
            <p>Many grateful recipients of his knowledge and his assistance have urged him to open a travel agency so that he might more formally help people experience the beautiful and diverse country. Father and son eventually turned it into a business in 2006. </p>
            <p>From these modest roots, they quickly set about creating Myanmar’s most reliable tour agency with innovative and exciting tours, opening the country up to curious, dynamic travelers. Despite their growth, Sammy’s vision still remains. Personal is how we began, and that’s how we continue to be.</p>
            <a href="#" class="read-more">READ MORE 
              <span class="read-more-arrow">
                <svg xmlns="/app/uploads/2025/11/pajamas_long-arrow.svg" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z"/>
                </svg>
              </span> 
            </a>
          </div>
        </div>
      </div>
    </div>

    <!-- OUR STORY TAB -->
    <div class="tab-pane fade" id="story" role="tabpanel">
      <div class="row align-items-center">
        <div class="col-md-5">
          <img src="/app/uploads/2025/11/5eae5a6f910d7ff97512c9b46cb5b25ef0fa3d03.jpg" class="img-fluid rounded" alt="Our story">
        </div>
        <div class="col-md-7">
          <p>Our Story</p>
        </div>
      </div>
    </div>

    <!-- OUR TEAM TAB -->
    <div class="tab-pane fade" id="team" role="tabpanel">
      <div class="row align-items-center">
        <div class="col-md-5">
          <img src="/app/uploads/2025/11/5eae5a6f910d7ff97512c9b46cb5b25ef0fa3d03.jpg" class="img-fluid rounded" alt="Our team">
        </div>
        <div class="col-md-7">
          <p>Our Team</p>
        </div>
      </div>
    </div>
  </div>
 </section>


<!-- Meet Our Team -->
<!-- <section class="team-section gap-y">
        <div class="container-fluid">
            <div class="row align-items-center justify-content-center">
                
                <div class="col-lg-5 col-md-6 p-4 p-md-5 text-white">
                    <h2 class="section-title fw-normal">MEET OUR TEAM</h2>
                    
                    <p class="lead mb-4">
                        We have a team of passionate travel designers for whom creating trips of a lifetime is so much more than just a job.
                    </p>
                    <button class="btn btn-custom-yellow px-4 py-2">
                        VIEW MORE
                    </button>
                </div>

                <div class="col-lg-5 col-md-6 p-4 p-md-0">
                    <img src="app/uploads/2025/11/asian-business-people-are-looking-their-business-plans-together-their-laptop-screens-2.png" class="img-fluid team-image shadow" alt="A team of people working together">
                </div>

            </div>
        </div>
    </section> -->

 <section class="team-section">
    <div class="container">
      <div class="row align-items-center">
        <!-- Left Content -->
        <div class="col-lg-7 mb-4 mb-md-0">
          <div class="team-content">
            <h5 class="team-title">MEET OUR TEAM</h5>
            <div class="underline"></div>
            <p class="team-text">
              We have a team of passionate travel designers for whom creating trips of a lifetime is so much more than just a job.
            </p>
            <button class="btn btn-gold">View More</button>
          </div>
        </div>

        <!-- Right Image -->
        <div class="col-lg-5">
          <img src="/app/uploads/2025/11/asian-business-people-are-looking-their-business-plans-together-their-laptop-screens-2.png" alt="Our Team">
        </div>
      </div>
    </div>
  </section>
 


  

<h1 class="test">testing</h1>