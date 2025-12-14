(function($){
    // vector map init (same as before)
    try{
        if (typeof jQuery !== 'undefined' && jQuery && jQuery.fn && jQuery.fn.vectorMap) {
            jQuery('#vmap').vectorMap({
                map: 'world_en',
                backgroundColor: null,
                color: '#ffffff',
                hoverOpacity: 0.7,
                selectedColor: '#1de9b6',
                enableZoom: true,
                showTooltip: true,
                values: window.sample_data || {},
                scaleColors: ['#1de9b6','#03a9f5'],
                normalizeFunction: 'polynomial'
            });
        }
    }catch(e){ console.warn('vmap init failed', e); }

    // logout helper
    window.logout = function(){
        try{ localStorage.removeItem('userData'); }catch(e){}
        try{ localStorage.removeItem('jwtToken'); }catch(e){}
    };

    // Safe init for user avatar / role
    (function initUser(){
        var user = null;
        try{ user = JSON.parse(localStorage.getItem('userData')); }catch(e){ user = null; }
        var span = document.getElementById('span-avatar');
        if (span) span.innerText = user && user.lastName ? ('Hi ' + user.lastName) : 'Hi';
        try{
            if (!user || String(user.roleId) !== '3'){
                var els = document.querySelectorAll('.hidden-user');
                for(var i=0;i<els.length;i++){ els[i].style.display = 'none'; }
            }
        }catch(e){}
    })();

    // Client-side XHR to fetch order by id
    (function(){
        function getQueryParam(name){
            try{ var urlParams = new URLSearchParams(window.location.search); return urlParams.get(name); }catch(e){return null}
        }
        function getToken(){
            try{
                return localStorage.getItem('jwtToken') || localStorage.getItem('token') || (document.cookie.match(/(^|;)\s*token=([^;]+)/) || [])[2] || null;
            }catch(e){return null}
        }
        function fmtMoney(n){ try { return Number(n).toLocaleString('en-US',{style:'currency',currency:'USD'}); } catch(e) { return String(n); } }

        var tbody = document.getElementById('orderItemsBody');
        var id = getQueryParam('id');
        if (!id){ if (tbody) tbody.innerHTML = '<tr><td colspan="4" class="text-center">Không có id đơn hàng</td></tr>'; return; }

        var backend = (window.APP_CONFIG && window.APP_CONFIG.backendUrl) ? window.APP_CONFIG.backendUrl : 'http://localhost:8000';
        var token = getToken();

        var xhr = new XMLHttpRequest();
        xhr.open('POST', backend + '/api/orders/get-by-id', true);
        xhr.setRequestHeader('Content-Type','application/json');
        if (token) xhr.setRequestHeader('Authorization','Bearer ' + token);

        xhr.onload = function(){
            if (!tbody) return;
            try{
                var resp = {};
                try{ resp = JSON.parse(xhr.responseText || '{}'); }catch(e){ resp = { message: 'Invalid JSON response' }; }

                // debug logs
                console.log('[order-detail] xhr.status', xhr.status);
                console.log('[order-detail] resp', resp);

                if (xhr.status === 200 && resp.errCode === 0 && resp.data){
                    var order = resp.data;
                    var buyer = order.buyer || {};
                    if (typeof buyer === 'string'){ try{ buyer = JSON.parse(buyer); }catch(e){ buyer = {}; } }

                    console.log('[order-detail] order.id ->', order.id);
                    console.log('[order-detail] order.orderCode ->', order.orderCode);
                    console.log('[order-detail] order.providerPaymentId ->', order.providerPaymentId);
                    console.log('[order-detail] order.createdAt ->', order.createdAt);
                    console.log('[order-detail] order.total ->', order.total);
                    console.log('[order-detail] order.status ->', order.status, 'statusText ->', order.statusText);
                    console.log('[order-detail] order.customer ->', order.customer);
                    console.log('[order-detail] parsed buyer ->', buyer);

                    // populate fields
                    try{ document.getElementById('od_customer').innerText = order.customer || ((buyer.firstName||'') + ' ' + (buyer.lastName||'')).trim() || '-'; }catch(e){}
                    try{ document.getElementById('od_email').innerText = buyer.email || '-'; }catch(e){}
                    try{ document.getElementById('od_address').innerText = (buyer.address ? buyer.address + (buyer.addressNote ? ' - ' + buyer.addressNote : '') : (buyer.addressNote || '-')); }catch(e){}
                    try{ document.getElementById('od_code').innerText = order.orderCode || order.providerPaymentId || ('ORD-' + order.id); }catch(e){}
                    try{ document.getElementById('od_created').innerText = order.createdAt ? (new Date(order.createdAt)).toLocaleString() : '-'; }catch(e){}
                    try{ document.getElementById('od_total').innerText = fmtMoney(order.total || 0); }catch(e){}
                    try{ document.getElementById('od_status').innerText = order.statusText || order.status || '-'; }catch(e){}

                    var items = Array.isArray(order.items) ? order.items : [];
                    console.log('[order-detail] items.length', items.length);
                    if (!items.length){ tbody.innerHTML = '<tr><td colspan="4" class="text-center">Không có sản phẩm</td></tr>'; return; }
                    var html = '';
                    for(var i=0;i<items.length;i++){
                        var it = items[i];
                        console.log('[order-detail] item#'+i, it);
                        var img = it.image ? ('../images/books/' + encodeURIComponent(it.image)) : '../images/books/no-image.png';
                        var title = it.bookname || it.name || '-';
                        var unit = it.unitPrice || it.price || 0;
                        var qty = it.quantity || it.qty || 1;
                        var subtotal = (typeof it.subtotal !== 'undefined') ? it.subtotal : (unit * qty);
                        html += '<tr>' +
                            '<td style="min-width:220px"><div style="display:flex;gap:12px;align-items:center"><img src="'+img+'" style="width:60px;height:auto" alt=""/><div>'+ title +'</div></div></td>' +
                            '<td class="text-right">'+ fmtMoney(unit) +'</td>' +
                            '<td class="text-center">'+ qty +'</td>' +
                            '<td class="text-right">'+ fmtMoney(subtotal) +'</td>' +
                        '</tr>';
                    }
                    tbody.innerHTML = html;
                    return;
                }

                var errMsg = (resp && resp.message) ? resp.message : ('Lỗi server (status ' + xhr.status + ')');
                tbody.innerHTML = '<tr><td colspan="4" class="text-center">'+ errMsg +'</td></tr>';

            }catch(e){
                console.error('order-detail onload error', e);
                tbody.innerHTML = '<tr><td colspan="4" class="text-center">Lỗi xử lý dữ liệu</td></tr>';
            }
        };

        xhr.onerror = function(){ if (tbody) tbody.innerHTML = '<tr><td colspan="4" class="text-center">Lỗi kết nối tới server</td></tr>'; };

        xhr.send(JSON.stringify({ id: Number(id) }));

    })();

})(window.jQuery);
