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
<footer style="background: #ddddddb5">
    <div class="container">
        <div class="row text-dark">
            <div class="col-md-4 py-2">
                {{-- <h2 class="fs-5 mb-4"><img height="80" width="150" src="{{ URL::asset('image/logo.png') }}" alt="ez lifestyle"></h2> --}}
                <p class="fs-6">Fitness and Strength have power to transform you and make you different from others. Driven by our passion for fitness and our instinct for innovation, we want to bring the best out of you. We want to stand on the same place where you are trying to strengthen yourself, and to achieve that Herculeen brand runs by <strong>Ez LifeStyle</strong> is based on very true values that promises a premium range of activewear, footwear and accessories.</p>
            </div>
            <div class="col-md-5 py-3">
                <div class="row">
                    <div class="col-md-6">
                        <h2 class="fs-5 mb-3">SERVICES</h2>
                        <ul class="list-unstyled">
                            <li>demo 1</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h2 class="fs-5 mb-3">QUICK LINKS</h2>
                        <ul class="list-unstyled">
                            @foreach ($service_categories as $category)
                                @if($category->menu_top === 1)
                                    <li><a class="text-dark" href="#">{{ $category->category_name }}</a></li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-3 py-3">
                <h2 class="fs-5 mb-4">CONTACT US</h2>
                <p class="fs-6 mb-0"><a class="text-dark" href="https://maps.app.goo.gl/ZLubmrRYNvFi3yBr9" target="_blank"><i class="fa-regular fa-address-book"></i> A-83, Sec. 65 Noida (201301) U.P. IND</a></p>
                <p class="fs-6 mb-0"><i class="fa-solid fa-phone"></i>  <a class="text-dark" href="tel:+917011661965">+91 70116 61965</a></p>
                <p class="fs-6 mb-0"><a href="https://wa.me/917011661965"><img height="35" src="{{ asset('image/whatsapp.png') }}" alt=""></a></p>
                <p class="fs-6 mb-0"><i class="fa-regular fa-envelope"></i> <a class="text-dark" href="mailto:contact@ezlifestyle.in">contact@ezlifestyle.in</a></p>
                <p class="fs-6 mb-0"><i class="fa-solid fa-globe"></i> <a class="text-dark" href="https://ezlifestyle.in">https://ezlifestyle.in</a></p>
            </div>
        </div>
    </div>
    <hr style="border-color:#000">
    <div class="text-center pb-3 text-dark">
        &copy; Copyright {{ date('Y') }} <a target="blank" href="https://www.ezlifestyle.in/">EZ Lifestyle</a>
    </div>
</footer>