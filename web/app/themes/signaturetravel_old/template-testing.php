<?php 
// Template Name: testing
get_header(); 
?>
<div class="py-5 testing">
  <div class="container">
    <div class="row">
      <div class="col-12 myanmar-safe">
        <p>
          ၂၀၂၆ ခုနှစ်၊ ဇန်နဝါရီလ၊ ၁၀ ရက် (စနေနေ့) သည် လွှဲပြောင်းနိုင်သော စာချုပ်၊ စာတမ်းအက်ဥပဒေအရအစားထိုး ရုံးဖွင့်ရက်ဖြစ်ပါသဖြင့် ထိုနေ့တွင် မြန်မာ့ရှေ့ဆောင်ဘဏ်၊ ဘဏ်ခွဲများအားလုံး ဖွင့်လှစ်ကာ ဘဏ်လုပ်ငန်းဝန်ဆောင်မှုများကို ရယူနိုင်မည်ဖြစ်ကြောင်း လေးစားစွာ ကြိုတင်အသိပေး အကြောင်းကြားအပ်ပါသည်။
        </p>
        
        <p>MAB Debit Card, MAB VISA Platinum Secured Credit Card တို့ကို အွန်လိုင်းမှတစ်ဆင့် လျှောက်ထားနိုင်ပါသည်။
        </p>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {

  if (!window.Intl || !Intl.Segmenter) return;

  const segmenter = new Intl.Segmenter("my", { granularity: "word" });

  document.querySelectorAll("p").forEach(el => {

    // Only process Myanmar text
    if (!/[\u1000-\u109F]/.test(el.textContent)) return;

    const walker = document.createTreeWalker(
      el,
      NodeFilter.SHOW_TEXT,
      null,
      false
    );

    let node;
    while ((node = walker.nextNode())) {
      const segments = segmenter.segment(node.nodeValue);
      let out = "";
      for (const s of segments) {
        out += s.segment + "\u2060";
      }
      node.nodeValue = out;
    }

  });
});
</script>
<?php get_footer(); ?>
