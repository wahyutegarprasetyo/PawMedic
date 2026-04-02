<!-- Scroll to Top Button -->
<button id="scrollTopBtn" class="scroll-top-btn" aria-label="Scroll to top">
    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M10 15V5M10 5L5 10M10 5L15 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
</button>

<style>
.scroll-top-btn{
    position:fixed;
    bottom:30px;
    right:30px;
    width:50px;
    height:50px;
    background:linear-gradient(135deg, var(--primary, #6fcf97) 0%, var(--primary-dark, #4bb66f) 100%);
    color:white;
    border:none;
    border-radius:50%;
    cursor:pointer;
    display:flex;
    align-items:center;
    justify-content:center;
    box-shadow:0 4px 16px rgba(111,207,151,0.4);
    transition:all 0.3s ease;
    z-index:1000;
    opacity:0;
    visibility:hidden;
    transform:translateY(20px);
}

.scroll-top-btn.visible{
    opacity:1;
    visibility:visible;
    transform:translateY(0);
}

.scroll-top-btn:hover{
    transform:translateY(-4px) scale(1.1);
    box-shadow:0 8px 24px rgba(111,207,151,0.5);
}

.scroll-top-btn:active{
    transform:translateY(-2px) scale(1.05);
}

@media(max-width:768px){
    .scroll-top-btn{
        bottom:20px;
        right:20px;
        width:44px;
        height:44px;
    }
}
</style>

<script>
const scrollTopBtn = document.getElementById('scrollTopBtn');

window.addEventListener('scroll', () => {
    if (window.pageYOffset > 300) {
        scrollTopBtn.classList.add('visible');
    } else {
        scrollTopBtn.classList.remove('visible');
    }
});

scrollTopBtn.addEventListener('click', () => {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
});
</script>
