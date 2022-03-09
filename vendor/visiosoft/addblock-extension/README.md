# Add Block Module
Belirtilen alanlara başka bir modülden eklemeler yapmanıza olanak sağlar.


## Blocks
- advs-module/ad-detail/partials/author-button
            
            {{ addBlock('ad-detail/partials/author-button', {'adv_id': adv.id})|raw }}
- advs-module/list/partials/ads

            {{ addBlock('ad-list/partials/ads',{'featured_advs':featured_advs})|raw }}

- profile-module/profile/partials/navigation

            {{ addBlock('profile/navigation')|raw }}
            
- advs-module/ad-detail/partials/detail

            {{ addBlock('ad-detail/seller/action',{'adv':adv})|raw }}
            
- advs-module/ad-detail/detail

            {{ addBlock('ad-detail/title/action',{'adv':adv})|raw }}

- profile-module/profile/partials/navigation

            {{ addBlock('profile/navigation')|raw }}
            
- advs-module/new-ad/new-create

            {{ addBlock('new-ad/fields')|raw }}
            

#Kullanım

        {{ addBlock('twig_dosya_adi',{'veri1':veri1,veri2:veri2,...})|raw }}

Örneğin;

Adv modülü ilan Detay sayfasına iletişim alanlarına Message Modülünün Butonunu eklemek.

advs-module/resources/views/ad-detail/partials/detail.twig

51.<--> 63.

                    <!-- Contact With Block -->
                    {% set contactWith = addBlock('ad-detail/contact-with',{'adv':adv}) %}
                    {% if contactWith != "" %}
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 offered-field offered-row">
                            <div class="row">
                                <div class="col-md-12 mt-2">
                                    <h4><u>{{ trans('visiosoft.module.advs::field.contact_with') }}:</u></h4>
                                </div>
                                {{ contactWith|raw }}
                            </div>
                        </div>
                    {% endif %}
                    <!-- Contact With Block -->
 
Belirtilen alan diğer tüm modüllerde views klasörü içinde "ad-detail/contact-with.twig" dosyasını arar.
Bulunan twig dosyalarını addBlock alanının oluşturdupu yere otomatik olarak getirmektedir.

Eklenen twig dosyası örneği;

profile-module/resources/views/ad-detail-contact-with.twig

Profil modülündelündeki örnekte Telefon bilgileri ilan detay sayfasına eklenmiştir.


##support@visiosoft.com.tr

www.visiosoft.com.tr



