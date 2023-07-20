function buy(){
    alert("Đơn hàng đã được đặt thành công");
}

    
setInterval(function(){
    var gia1=document.getElementById('amount1').value;
    var donGia1=document.getElementById('donGia1').innerText;
    var tongGia1=gia1*donGia1;
    var span1=document.getElementById('tongGia1');
    span1.textContent=tongGia1;

    var gia2=document.getElementById('amount2').value;
    var donGia2=document.getElementById('donGia2').innerText;
    var tongGia2=gia2*donGia2;
    var span2=document.getElementById('tongGia2');
    span2.textContent=tongGia2;

    var gia3=document.getElementById('amount3').value;
    var donGia3=document.getElementById('donGia3').innerText;
    var tongGia3=gia3*donGia3;
    var span3=document.getElementById('tongGia3');
    span3.textContent=tongGia3;

    var subtotal=document.getElementById('subtotal');
    var shipping=document.getElementById('shipping');
    var total=document.getElementById('total');

    subtotal.textContent=tongGia1+tongGia2+tongGia3;
    shipping.textContent=(parseInt(gia1)+parseInt(gia2)+parseInt(gia3))*10000;
    total.textContent=parseInt(subtotal.textContent)+parseFloat(shipping.textContent);
});