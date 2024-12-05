
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Email</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body style="padding: 0px; margin: 0px;background-color: #f0eded;">
    <div class="container">
        <div class="row">

            <div class="col-lg-6 col-md-12 col-sm-12" style="padding: 0px; margin: 0px auto; background-color: #ffffff;">
                <div style="height: 100px; background: #0c2039; text-align: center; border-bottom: 5px solid #b19347;">
                    <img style="margin-top: 30px;" src="{{asset('mailassets/buyermails/regmail/img/logo-img.png')}}" alt="logo">
                </div>
                <div>
                    <h1 class="fs-1 fw-bold mt-5 pt-3" style="color: #0c192c; font-family: Bagoss Standard TR IA L;font-style: italic; text-align: center;">Welcome to <span style="color:#b19347">Mustakshif</span></h1>
                </div>

                <div style="display: flex; padding: 0px; margin: 40px 0px 30px;">


                <div style="height: 100%; width: 100%; background-repeat: no-repeat; background-size: cover; background-position: center; padding: 80px 20px 80px 30px; background-image: url({{asset('mailassets/buyermails/regmail/img/banner 1.png')}});">

                        <h2 style="color: #0c192c; font-family: Bagoss Standard TR IA L; font-size: 28px;font-style: italic;  line-height: 34px; font-weight: bold; text-align: left;">Discover<br>
                            the World of<br>
                            <span style="color:#b19347"> Halal Products</span><br>
                            with a quick scan!</h2>

                    </div>

                    </div>

                <div style="text-align: center; padding: 0px;">

                        <h3 style="color: #000; font-family: Bagoss Standard TR IA L; font-size: 24px; line-height: 44px; font-weight: bold; text-align: center; padding: 0px;">Dear [<span style="color:#89b9ff">{{$name}}</span>]</h3>
                </div>

                <div>
                    <p class="px-4" style="color: #000; font-family: Bagoss Standard TR IA L; font-size: 18px; line-height: 26px; text-align: center;">As-Salamu Alaykum,
                        Welcome to Mustakshif, the ultimate destination for all your
                        Halal product scanning needs! We are thrilled to have you join our growing community of conscious consumers.
                        </p>

                    </div>

                    <div style="text-align: center; padding: 0px;">

                            <h2 style="color: #0c192c; font-family: Bagoss Standard TR IA L; font-size: 24px; line-height: 44px; font-weight: bold; text-align: center; padding: 0px;">Scan Smart, Eat Halal</h2>
                    </div>
                    <div style="display: grid; grid-template-columns: repeat(2,1fr); justify-content: center; gap: 20px; text-align: center;  padding: 0px 20px 0px 20px; margin: -20px 0px 0px 0px;">


                        <div>
                        <img style="margin-top: 30px;" src="{{asset('mailassets/buyermails/regmail/img/live icon.png')}}" alt="icon">

                                <h3 style="margin-top: 10px; color: #0c192c; font-family: Bagoss Standard TR IA L; font-size: 18px; line-height: 18px; font-weight: bold; text-align: center;">Halal Alternatives</h3>
                                <p style="color: #0c192c; font-family: Bagoss Standard TR IA L; font-size: 18px; line-height: 26px; text-align: center;">Find ethically sourced, halal
                                    alternatives to forbidden
                                    products.</p>
                            </div>

                            <div>
                                <img style="margin-top: 30px;" src="{{asset('mailassets/buyermails/regmail/img/time.png')}}" alt="icon">

                                        <h3 style="margin-top: 10px; color: #0c192c; font-family: Bagoss Standard TR IA L; font-size: 18px; line-height: 18px; font-weight: bold; text-align: center;">Real-time Product Updates</h3>
                                        <p style="color: #0c192c; font-family: Bagoss Standard TR IA L; font-size: 18px; line-height: 26px; text-align: center;">Stay informed with the latest product status information.</p>
                                    </div>

                                    <div>
                                        <img style="margin-top: 20px;" src="{{asset('mailassets/buyermails/regmail/img/notification icon.png')}}" alt="icon">

                                                <h3 style="margin-top: 10px; color: #0c192c; font-family: Bagoss Standard TR IA L; font-size: 18px; line-height: 18px; font-weight: bold; text-align: center;">Custom Reminders</h3>
                                                <p style="color: #0c192c; font-family: Bagoss Standard TR IA L; font-size: 18px; line-height: 26px; text-align: center;">Azan notifications, Qibla finder, prayer/ Azkar reminder.</p>
                                            </div>

                                            <div>
                                                <img style="margin-top: 20px;" src="img/active icon.png" alt="icon">

                                                        <h3 style="margin-top: 10px; color: #0c192c; font-family: Bagoss Standard TR IA L; font-size: 18px; line-height: 18px; font-weight: bold; text-align: center;">Push Notifications</h3>
                                                        <p style="color: #0c192c; font-family: Bagoss Standard TR IA L; font-size: 18px; line-height: 26px; text-align: center;">Get instant alerts on important updates and new discoveries.</p>
                                                    </div>
                                                    <div>
                                                        <img style="margin-top: 30px;" src="img/live icon.png" alt="icon">

                                                                <h3 style="margin-top: 10px; color: #0c192c; font-family: Bagoss Standard TR IA L; font-size: 18px; line-height: 18px; font-weight: bold; text-align: center;">Live Streaming & Updates</h3>
                                                                <p style="color: #0c192c; font-family: Bagoss Standard TR IA L; font-size: 18px; line-height: 26px; text-align: center;">Makkah and Madinah Live TV online and live updates of scanning. </p>
                                                            </div>
                        </div>

                                <div style="text-align: center;">

                                    <a href="#">
                                    <button style="background-color: #b19347; border: none; margin: 10px 0px 20px 0px; padding: 8px 15px; font-size: 18px; line-height: 40px; text-transform: uppercase; color: #ffffff; font-weight: bold; text-align: center; font-family: Switzer;">Explore More Features</button></a>

                                    </div>

                                <div style="display: flex; padding: 0px; margin: 30px 0px 20px 0px;">


                                        <div style="width: 100%; background-repeat: no-repeat; background-size: cover; background-position: center; padding: 30px 20px 30px 30px; background-image: url(img/banner\ 2.png);">

                                                <h2 style="color: #0c192c; font-family: Switzer; font-size: 24px;font-style: italic;  line-height: 32px; font-weight: bold; text-align: left;">Life-Long Subscription<br>
                                                    Unlimited Access,<br>
                                                    Forever Yours!</h2>

                                                    <div>
                                                        <p style="color: #0c192c; font-family: Bagoss Standard TR IA L; font-size: 18px; line-height: 26px; text-align: left; margin-top: 10px;">Say goodbye to recurring app charges.</p>

                            <p style="color: #0c192c; font-family: Bagoss Standard TR IA L; font-size: 18px; line-height: 26px; text-align: left; margin-top: 10px;"> Exclusive upgrades and every new<br> feature are at your fingertips<br> without ever asking for more.
                                                            </p>

                                                        </div>

                                            </div>

                                </div>

                                <div style="display: flex; padding: 0px; margin: 40px 0px 20px 0px;">


                                                <div style="background-color: #fff; height: 100%; width: 100%; background-repeat: no-repeat; background-size: contain; background-position: left; padding: 0px 30px 0px 20px; background-image: url(img/banner\ 3.png);">
                                                    <div class="px-5 py-2 sm-px-3" style="float: right; background-color: #ffffff91; border-top-left-radius: 40px; border-bottom-left-radius: 40px;" >
                                                        <h2 style="color: #0c192c; font-family: Switzer; font-size: 24px;font-style: italic;  line-height: 32px; font-weight: bold; text-align: left;">Rewarding Experience</h2>

                                                            <div>
                                                                <p style="color: #0c192c; font-family: Bagoss Standard TR IA L; font-size: 18px; line-height: 26px; text-align: left; margin-top: 10px;">Scan, Earn, and Be Rewarded!<br>
                                                                    Unlock exciting awards and<br> points for your valuable efforts by<br> contributing to our app, adding<br> new products, and more.
                                                                     </p>
                                                                     <div style="display: flex; gap: 15px;  padding: 0px 0px 0px 0px; margin: -20px 0px 0px 0px;">

                                                                        <div style="background-color: #f7f7f7; border: none; margin: 20px 0px 20px 0px; padding: 15px 15px 15px 15px; font-size: 18px; line-height: 18px; color: #0c192c; font-weight: bold; text-align: center; font-family: Switzer;">10+ points</div>

                                                                            <div style="background-color: #f7f7f7; border: none; margin: 20px 0px 20px 0px; padding: 15px 10px 15px 10px; font-size: 18px; line-height: 18px; color: #0c192c; font-weight: bold; text-align: center; font-family: Switzer;">e-gift cards</div>

                                                                        </div>
                                                                </div>
                                                        </div>

                                                    </div>

                                </div>

                                <div style="text-align: center; padding: 0px 0px 0px 0px;margin-top: 40px; ">
                                                        <div>
                                                            <h2 style="color: #0c192c; font-family: Switzer; font-size: 24px; line-height: 32px; font-weight: bold; text-align: center; padding: 0px; font-style: italic;">Halal Shopping<br>
                                                                Where Ethical Shopping Begins!</h2>
                                                    </div>

                                                    <div>
                                                        <p class="px-4" style="color: #000; font-family: Bagoss Standard TR IA L; font-size: 18px; line-height: 26px; text-align: center;">Embrace a mindful shopping experience like never before. Scan your cosmetics, pharmaceuticals, groceries, toiletries, and conveniences. </p>

                                                        </div>

                                                        <div style="text-align: center;">

                                                            <a href="#">
                                                            <button style="background-color: #b19347; border: none; margin: 10px 0px 20px 0px; padding: 8px 15px; font-size: 18px; line-height: 40px; text-transform: uppercase; color: #ffffff; font-weight: bold; text-align: center; font-family: Switzer;">Contribute Now</button></a>

                                                            </div>

                                                           <div>
                                                            <img style="margin-top: 20px; width: 100%;" src="img/banner 4.png" alt="icon">
                            </div>
                            <div>
                                <p style="padding: 30px; margin: 0px; color: #000; font-family: Bagoss Standard TR IA L; font-size: 18px; line-height: 26px; text-align: center;">Thank you for choosing us to be your guide in making informed choices according to Islamic Shariah.</p>

                                </div>

                                    <div class="p-3" style="background: #0c2039; display: flex; justify-content: space-between; align-items: center;">
                                        <div>
                                            <p style="color: #fff; font-family: Switzer; font-size: 18px; line-height: 25px; font-weight: 500; text-align: left; margin-bottom: 0px;">Warm Regards,</p>

                                            <p class="m-0" style="color: #fff; font-family: Switzer; font-weight: 800; font-style: italic; font-size: 20px; text-align: left;">Mustakshif Team</p>

                                        </div>

                                        <img src="img/logo.png" alt="logo">
                                    </div>



                                </div>

                </div>
        </div>
    </div>




</div>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>
</html>
