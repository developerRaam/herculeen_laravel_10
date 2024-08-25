<style>
    .list-unstyled{
        line-height: 34px
    }
    a{
        text-decoration: none;
    }
    @media(min-width: 768px){
        footer{
            padding-top: 50px
        }
    }
    @media(max-width: 768px){
        footer{
            padding-top: 50px;
            padding-bottom: 50px;
        }
    }
</style>
<footer style="background: #000">
    <div class="container">
        <div class="row text-white">
            <div class="col-md-4 py-3">
                <h2 class="fs-3 mb-4"><img height="80" width="150" src="{{ URL::asset('image/logo.png') }}" alt="ez lifestyle"></h2>
                {{-- <p>Our journey starts in the vibrant world of garment manufacturing, where innovation and business meet. Tucked away in the center of innovation, EZ Lifestyle stands out as a model of quality, serving only companies looking for high-end apparel…</p> --}}
            </div>
            <div class="col-md-5 py-3">
                <div class="row">
                    <div class="col-md-6">
                        <h2 class="fs-3 mb-4">SERVICES</h2>
                        <ul class="list-unstyled">
                            <li>Design</li>
                            <li>Fabric</li>
                            <li>Pattern Making</li>
                            <li>Clothing Manufacturing</li>
                            <li>Photo Shoot</li>
                            <li>Logo Design</li>
                            <li>Logo Sticker Printing</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h2 class="fs-3 mb-4">QUICK LINKS</h2>
                        <ul class="list-unstyled">
                            <li><a class="text-white" href="#">Register As A Brand</a></li>
                            <li><a class="text-white" href="#">Register As A Retailer</a></li>
                            <li><a class="text-white" href="#">Register As A Wholesaler</a></li>
                            <li><a class="text-white" href="#">Our Story</a></li>
                            <li><a class="text-white" href="#">Contact Us</a></li>
                            <li><a class="text-white" href="#">Blog</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-3 py-3">
                <h2 class="fs-3 mb-4">CONTACT US</h2>
                <p><a class="text-white" href="https://maps.app.goo.gl/ZLubmrRYNvFi3yBr9" target="_blank"><i class="fa-regular fa-address-book"></i> A-83, Sec. 65 Noida (201301) U.P. IND</a></p>
                <p><i class="fa-solid fa-phone"></i>  <a class="text-white" href="tel:+917011661965">+91 70116 61965</a></p>
                <p><a href="https://wa.me/917011661965"><img height="35" src="{{ asset('image/whatsapp.png') }}" alt=""></a></p>
                <p><i class="fa-regular fa-envelope"></i> <a class="text-white" href="mailto:contact@ezlifestyle.in">contact@ezlifestyle.in</a></p>
                <p><i class="fa-solid fa-globe"></i> <a class="text-white" href="https://ezlifestyle.in">https://ezlifestyle.in</a></p>
            </div>
        </div>
    </div>
    <hr style="border-color:#ddd">
    <div class="text-center pb-3 text-light">
        @ Copyright 2024 EZ Lifestyle
    </div>
</footer>