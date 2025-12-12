  //header

const hb = document.querySelector('.hamburger');
const menu = document.getElementById('mainMenu');
hb && hb.addEventListener('click', () => {
  const expanded = hb.getAttribute('aria-expanded') === 'true';
  hb.setAttribute('aria-expanded', !expanded);
  menu.classList.toggle('open');

  // اضافه کردن کلاس به body برای جلوگیری از اسکرول
  document.body.classList.toggle('menu-open', menu.classList.contains('open'));
});






(function(){
    // swatches
    const swatches = document.querySelectorAll(".swatch");
    swatches.forEach(swatch => {
      swatch.addEventListener("click", () => {
        swatches.forEach(s => s.classList.remove("active"));
        swatch.classList.add("active");
      });
      swatch.addEventListener("keydown", (e) => {
        if (e.key === "Enter" || e.key === " ") {
          e.preventDefault();
          swatch.click();
        }
      });
    });

    // sizes
    const sizeBtns = document.querySelectorAll(".size-btn");
    sizeBtns.forEach(btn => {
      btn.addEventListener("click", () => {
        sizeBtns.forEach(b => b.classList.remove("active"));
        btn.classList.add("active");
      });
    });

    // qty & price
    const minusBtn = document.getElementById("minus");
    const plusBtn = document.getElementById("plus");
    const qtyValue = document.getElementById("qty-value");
    const unitPriceEl = document.getElementById("unit-price");
    let unitPrice = parseInt(unitPriceEl.getAttribute("data-price"), 10) || 0;
    let qty = 1;
    function updatePrice(){ unitPriceEl.textContent = (unitPrice * qty).toLocaleString('fa-IR'); }
    plusBtn.addEventListener("click", ()=>{ qty++; qtyValue.textContent = qty; updatePrice(); });
    minusBtn.addEventListener("click", ()=>{ if(qty>1){ qty--; qtyValue.textContent = qty; updatePrice(); } });

    // gallery thumbnails -> main image
    const thumbImgs = document.querySelectorAll(".thumb img");
    const mainImage = document.getElementById("main-image");
    thumbImgs.forEach(img => {
      img.addEventListener("click", function() {
        const large = this.dataset.large || this.src;
        mainImage.style.opacity = 0;
        setTimeout(()=>{ mainImage.src = large; mainImage.style.opacity = 1; }, 150);
      });
    });

    // thumbs nav arrows scroll
    const prevBtn = document.querySelector(".thumb-arrow.prev");
    const nextBtn = document.querySelector(".thumb-arrow.next");
    const thumbsEl = document.querySelector(".thumbs");
    prevBtn.addEventListener("click", ()=> thumbsEl.scrollBy({ left: -150, behavior: 'smooth' }));
    nextBtn.addEventListener("click", ()=> thumbsEl.scrollBy({ left: 150, behavior: 'smooth' }));
  })();

  (function(){
    const stars = document.querySelectorAll("#rating-input .star") || document.querySelectorAll(".rating-input .star");
    const ratingInput = document.getElementById("review-rating");
    let currentRating = parseInt(ratingInput?.value || 5, 10) || 5;

    function renderStars(v){
      (stars || []).forEach(s => {
        const val = parseInt(s.dataset.value, 10);
        s.classList.toggle('filled', val <= v);
      });
    }
    renderStars(currentRating);

    (stars || []).forEach(s => {
      s.addEventListener('click', ()=> {
        currentRating = parseInt(s.dataset.value,10);
        if (ratingInput) ratingInput.value = currentRating;
        renderStars(currentRating);
      });
      s.addEventListener('keydown', (e)=>{
        if(e.key === 'Enter' || e.key === ' '){ e.preventDefault(); s.click(); }
      });
    });

    
    const reviewForm = document.getElementById('review-form');
    const reviewsList = document.getElementById('reviews-list');

    reviewForm && reviewForm.addEventListener('submit', function(e){
      e.preventDefault();

      const name = document.getElementById('review-name').value.trim();
      const email = document.getElementById('review-email').value.trim();
      const text = document.getElementById('review-text').value.trim();
      const rating = parseInt(document.getElementById('review-rating').value,10) || 5;

      if(!name || !email || !text){
        alert('لطفاً همه فیلدها را تکمیل کنید.');
        return;
      }

      const item = document.createElement('div');
      item.className = 'review-item';
      const date = new Date();
      const persianDate = new Intl.DateTimeFormat('fa-IR').format(date);

      item.innerHTML = `
        <div class="review-meta">
          <div class="avatar">${escapeHtml((name[0] || 'U').toUpperCase())}</div>
          <div>
            <div class="name-date">${escapeHtml(name)} — <span class="date">${persianDate}</span></div>
            <div class="stars small">${'★'.repeat(rating)}${'☆'.repeat(5-rating)}</div>
          </div>
        </div>
        <div class="review-text">${escapeHtml(text)}</div>
      `;

      reviewsList.insertBefore(item, reviewsList.firstChild);

      reviewForm.reset();
      document.getElementById('review-rating').value = 5;
      renderStars(5);

    
    });

    function escapeHtml(str){
      return String(str).replace(/[&<>"']/g, function(m){ return ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#039;'}[m]); });
    }
  })();