<!-- Toast Notification System -->
<div id="toastContainer" class="toast-container"></div>

<style>
.toast-container{
    position:fixed;
    top:20px;
    right:20px;
    z-index:10000;
    display:flex;
    flex-direction:column;
    gap:12px;
    pointer-events:none;
}

.toast{
    background:white;
    padding:16px 20px;
    border-radius:12px;
    box-shadow:0 8px 24px rgba(0,0,0,0.15);
    display:flex;
    align-items:center;
    gap:12px;
    min-width:300px;
    max-width:400px;
    pointer-events:auto;
    animation:toastSlideIn 0.3s ease;
    border-left:4px solid;
    position:relative;
    overflow:hidden;
}

.toast::before{
    content:'';
    position:absolute;
    left:0;
    top:0;
    bottom:0;
    width:4px;
    background:currentColor;
}

.toast.success{
    border-left-color:#10b981;
    color:#065f46;
}

.toast.error{
    border-left-color:#ef4444;
    color:#991b1b;
}

.toast.info{
    border-left-color:#3b82f6;
    color:#1e40af;
}

.toast.warning{
    border-left-color:#f59e0b;
    color:#92400e;
}

.toast-icon{
    font-size:20px;
    flex-shrink:0;
}

.toast-content{
    flex:1;
}

.toast-title{
    font-weight:600;
    font-size:15px;
    margin-bottom:4px;
}

.toast-message{
    font-size:14px;
    opacity:0.8;
}

.toast-close{
    background:none;
    border:none;
    font-size:18px;
    cursor:pointer;
    opacity:0.5;
    transition:opacity 0.2s;
    padding:0;
    width:24px;
    height:24px;
    display:flex;
    align-items:center;
    justify-content:center;
}

.toast-close:hover{
    opacity:1;
}

@keyframes toastSlideIn{
    from{
        transform:translateX(400px);
        opacity:0;
    }
    to{
        transform:translateX(0);
        opacity:1;
    }
}

@keyframes toastSlideOut{
    from{
        transform:translateX(0);
        opacity:1;
    }
    to{
        transform:translateX(400px);
        opacity:0;
    }
}

.toast.hiding{
    animation:toastSlideOut 0.3s ease forwards;
}
</style>

<script>
function showToast(message, type = 'info', title = null) {
    const container = document.getElementById('toastContainer');
    if (!container) return;
    
    const toast = document.createElement('div');
    toast.className = `toast ${type}`;
    
    const icons = {
        success: '✅',
        error: '❌',
        warning: '⚠️',
        info: 'ℹ️'
    };
    
    toast.innerHTML = `
        <div class="toast-icon">${icons[type] || icons.info}</div>
        <div class="toast-content">
            ${title ? `<div class="toast-title">${title}</div>` : ''}
            <div class="toast-message">${message}</div>
        </div>
        <button class="toast-close" onclick="this.parentElement.remove()">×</button>
    `;
    
    container.appendChild(toast);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        toast.classList.add('hiding');
        setTimeout(() => toast.remove(), 300);
    }, 5000);
}

// Make it globally available
window.showToast = showToast;
</script>
