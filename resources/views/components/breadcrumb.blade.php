<!-- Breadcrumb Navigation -->
<nav class="breadcrumb" aria-label="Breadcrumb">
    <ol class="breadcrumb-list">
        @foreach($items as $index => $item)
            @if($index < count($items) - 1)
                <li class="breadcrumb-item">
                    <a href="{{ $item['url'] }}">{{ $item['label'] }}</a>
                </li>
                <li class="breadcrumb-separator">›</li>
            @else
                <li class="breadcrumb-item active">{{ $item['label'] }}</li>
            @endif
        @endforeach
    </ol>
</nav>

<style>
.breadcrumb{
    margin-bottom:24px;
    animation:fadeDown 0.4s ease;
}

.breadcrumb-list{
    display:flex;
    align-items:center;
    gap:8px;
    list-style:none;
    padding:0;
    margin:0;
    flex-wrap:wrap;
}

.breadcrumb-item{
    font-size:14px;
}

.breadcrumb-item a{
    color:var(--text-muted, #64748b);
    text-decoration:none;
    transition:color 0.2s ease;
    font-weight:500;
}

.breadcrumb-item a:hover{
    color:var(--primary-dark, #4bb66f);
}

.breadcrumb-item.active{
    color:var(--text-dark, #114d3a);
    font-weight:600;
}

.breadcrumb-separator{
    color:var(--text-muted, #64748b);
    font-size:16px;
    user-select:none;
}
</style>
