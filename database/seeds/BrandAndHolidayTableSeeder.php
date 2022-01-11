<?php

use Illuminate\Database\Seeder;
use App\Brand;
use App\HolidayType;

class BrandAndHolidayTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     
    public function getArray()
    {
        return [
            // 'Unforgettable Cruise' => [
            //         'UCruises: Bali',
            //         'UCruises: Barbados & Grenadines',
            //         'UCruises: Cape Verde',
            //         'UCruises: Costa Rica & Panama',
            //         'UCruises: Croatia',
            //         'UCruises: Cuba',
            //         'UCruises: Egypt',
            //         'UCruises: Greece',
            //         'UCruises: Iceland',
            //         'UCruises: Maldives',
            //         'UCruises: Mekong',
            //         'UCruises: Seychelles',
            //         'UCruises: Spain & Portugal',
            // ],
            'Cruise Croatia' => [
               'Cruise',
               'Gulet Charter',
               'Yacht Charter',
               'Cruise and stay',
            ],
            'Unforgettable Croatia' => [
                'UCroatia: Activity Holiday',
                'UCroatia: Cruise',
                'UCroatia: Cruise & Stay',
                'UCroatia: Escorted Tour',
                'UCroatia: Single Destination',
                'UCroatia: Tailor Made',
            ],
            'Unforgettable Greece' => [
                'UGCruise',
                'UGCruiseStay',
                'UGTailormade',
            ],
            'Unforgettable Travel' => [
                'Africa Safaris',
                'Cultural & Heritage',
                'Family Adventures',
            ],
        ];
    }
    
    public function brandAboutUs($value)
    {
        $about = null;
        switch ($value) {
            // case 'Unforgettable Cruise':
            //     $about  = ' 
            //     <h4>Unforgettable Cruise </h4>
            //         <p>
            //         Founded in 2015 and through a mixture of hard work, determination and a bit of good fortune, we’ve became experts on small ship cruising after launching our sister brand, Unforgettable Croatia. With offices in London and San Francisco, we are now proud to be one of the largest small ship cruise companies in the Adriatic with several thousand guests travelling with us each year.
            //         As a team of people who know a lot about creating unique travel experiences and small ship cruising, we have expanded our portfolio of hand-picked small vessels to other truly spectacular destinations around the world. Our motto could not be more fitting – Small Ships, Big Experiences.
            //         </p>';
            //     break;
            case 'Cruise Croatia':
                $about  = ' 
                <h4>Cruise Croatia </h4>
                    <p>
                    Cruise Croatia is a privately-owned UK company specialising in crafting and selling cruise and sailing trips to Croatia, with offices in London, Split, San Francisco and Melbourne. All personal information that is provided to us or gathered by us is managed and controlled by Cruise Croatia, which is registered at 86-90 Paul Street, London EC2A 4NE.
                    </p>';
                break;
            case 'Unforgettable Croatia':
                $about  = ' 
                <h4>Unforgettable Croatia </h4>
                    <p>
                    Welcome to Unforgettable Croatia, we are the largest luxury tour operator to Croatia with offices in San Francisco, New York, London and Split, Croatia. We are connoisseurs of unique travel experiences and truly unforgettable trips to this magnificent country.
                    We live and breathe Croatia, with the majority of our team of Croatian heritage. As Croatia’s leading travel specialists we have developed an enviable VIP list of contacts throughout the country, which we use to ensure our clients enjoy unparalleled levels of service at top hotels, restaurants and with our hand-picked private guides.
                    </p>';
                break;
            case 'Unforgettable Greece':
                $about  = ' 
                <h4>Unforgettable Croatia </h4>
                <h4>SIZE MATTERS.</h4>
                <p>Founded in 2015 and through a mixture of hard work, determination and a bit of good fortune, we’ve become the largest luxury travel company to Croatia with our sister brand, Unforgettable Croatia. With offices in San Francisco, London and Melbourne we have thousands of happy clients returning from Croatia each year. In 2018, we decided to apply our successful formula in Croatia, to another country we are passionate about, Greece.</p>
                
                <h4>WE LOVE GREECE.</h4>
                <p>With no fewer than 18 UNESCO Protected sites, magnificent islands home to some of the world’s most beautiful beaches, vibrant cities bursting with culture and opportunities to delve into fine locally produced wines and mouthwatering Greek cuisine, it’s easy to see why we’re so passionate about Greece.</p>
                
                <h4>OUR CONTACTS ARE UNBEATABLE.</h4>
                <p>As we specialize in luxury trips to Greece, we’ve built an enviable list of black book contacts throughout the country, from the mainland to the smallest of islands. With our contacts, we are able to ensure our guests enjoy hotel upgrades, queue jumps and private unique experiences everywhere we can.</p>
                
                <h4>WE OFFER TRUE 24/7 CONCIERGE SERVICE.</h4>
                <p>From the moment you get in touch to discuss your trip to your return home with vacation blues, we’ve got your back. With a team of very experienced Greek travel specialists and a dedicated concierge team, we ensure that you not only have the perfect itinerary, but a personal concierge service right throughout your journey with us.</p>
                
                <h4>WE’VE BUILT OUR OWN TRAVEL APP.</h4>
                <p>In addition to beautifully presented welcome packs on arrival, we’ve also developed the perfect travel companion. With your itinerary, documents, personalized maps, restaurant recommendations, travel check lists, destination guides and more uploaded into one app, you don’t even need to be connected to Wifi to access them.</p>
                
                <h4>YOU’RE FULLY PROTECTED.</h4>
                <p>As members of ABTOT, ATOL and ASTA you are fully protected and our bonding means that your trip with us is 100% financially protected.</p>';
                break;
            case 'Unforgettable Travel':
                $about  = ' 
                <h4>Unforgettable Travel</h4>
                   <h3 style="font-family: Helvetica, Arial, sans-serif; font-weight: 700; line-height: normal; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; color: rgb(89, 89, 89); font-size: 24px; padding: 0px 0px 10px; position: relative;">Why do Ordinary</h3><p style="font-size: 17px; color: rgb(65, 65, 65); letter-spacing: 0.5px; line-height: 22px; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; font-family: Helvetica, Arial, sans-serif;">The&nbsp;<strong>Unforgettable Travel Company</strong>&nbsp;has grown to be a&nbsp;<em>leading luxury travel company</em>&nbsp;with offices in&nbsp;<strong>London</strong>,&nbsp;<strong>San Francisco</strong>&nbsp;and&nbsp;<strong>Split</strong>.</p><p style="font-size: 17px; color: rgb(65, 65, 65); letter-spacing: 0.5px; line-height: 22px; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; font-family: Helvetica, Arial, sans-serif;">As our strapline suggests we specialize in designing really intricate and unforgettable journeys for our clients. We live and breathe the destinations we send our clients to and therefore we love designing personalized itineraries which include a mixture of fascinating destinations, truly immersive experiences and perhaps relaxing beach time at the end.</p><p style="font-size: 17px; color: rgb(65, 65, 65); letter-spacing: 0.5px; line-height: 22px; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; font-family: Helvetica, Arial, sans-serif;">We have developed an enviable black book of contacts from the finest local guides to private drivers full of knowledge and personality. We focus on the tiniest detail in your trip, so you don’t have to.</p><h3 style="font-family: Helvetica, Arial, sans-serif; font-weight: 700; line-height: normal; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; color: rgb(89, 89, 89); font-size: 24px; padding: 0px 0px 10px; position: relative;">Personal Service, Exemplified</h3><p style="font-size: 17px; color: rgb(65, 65, 65); letter-spacing: 0.5px; line-height: 22px; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; font-family: Helvetica, Arial, sans-serif;">We’ve built our brands around a DNA for simply unrivalled personal service. Our ethos stems from our passionate team of travel experts to the hand-picked local guides we work with, all of whom are our brand ambassadors. Whilst companies talk about offering concierge service, with us this comes as standard. From the moment you get in touch to discuss your trip, to your return home with holiday blues, we’ve got your back.</p><p style="font-size: 17px; color: rgb(65, 65, 65); letter-spacing: 0.5px; line-height: 22px; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; font-family: Helvetica, Arial, sans-serif;">Attention to detail and caring for the little touches is the art of perfect trip planning, with us this is personified. With beautiful pre-departure travel packs, luxury travel accessories, an intuitive travel app, thoughtful touches throughout your journey to hand written welcome home cards. With us everything is personal.</p><h3 style="font-family: Helvetica, Arial, sans-serif; font-weight: 700; line-height: normal; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; color: rgb(89, 89, 89); font-size: 24px; padding: 0px 0px 10px; position: relative;">Guaranteed Peace of Mind</h3><p style="font-size: 17px; color: rgb(65, 65, 65); letter-spacing: 0.5px; line-height: 22px; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; font-family: Helvetica, Arial, sans-serif;">Each year we have several thousand clients travel with us from around the world.&nbsp;We are also a fully licensed ATOL and ABTOT bonded tour operator, therefore every client that books a trip with us is fully financially protected. Peace of mind guaranteed.</p><p style="font-size: 17px; color: rgb(65, 65, 65); letter-spacing: 0.5px; line-height: 22px; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; font-family: Helvetica, Arial, sans-serif;">Our Flexi-Promise gives clients the opportunity to book a trip to over 40 worldwide destinations and only pay a deposit of 10% with a full refund guarantee, if you cancel at least 45 days prior to the departure.</p><p style="font-size: 17px; color: rgb(65, 65, 65); letter-spacing: 0.5px; line-height: 22px; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; font-family: Helvetica, Arial, sans-serif;"><br></p>';
                break;
        }
        
        return $about;
    }
     
    public function run()
    {
        foreach ($this->getArray() as $key => $value) {
            $brand = Brand::create(['name' => $key, 'about_us' => $this->brandAboutUs($key)]);
            foreach ($value as $holiday) {
                HolidayType::create([
                    'brand_id'  => $brand->id,
                    'name'      => $holiday,
                ]);
            }
        }
    }
}
