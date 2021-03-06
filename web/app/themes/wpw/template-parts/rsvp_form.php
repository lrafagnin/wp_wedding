<?php
/**
 * Template part for displaying RSVP form.
 *
 * @package wpw
 */
?>
<form id="contactForm" data-toggle="validator" action="/wp-json/wpw/1/rsvp">
<div class="row">
    <div class="col-lg-12">
        <h5><?php pll_e('Your details');?></h5>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <input name="guest[]" class="form-control" type="text" placeholder="<?php pll_e('Full name')?> *" required>
                </div>
            </div>
            <div class="col-md-4">
                <select name="event[]" class="selectpicker" required>
                    <option value=""><?php pll_e('Select events');?></option>
                    <option value="reception_brunch"><?php pll_e('Reception & Brunch');?></option>
                    <option value="reception"><?php pll_e('Reception');?></option>
                    <option value="apologies"><?php pll_e('Apologies, I will not be able to attend');?></option>
                </select>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <input name="diet[]" class="form-control" type="text" placeholder="<?php pll_e('Special dietary')?>">
                </div>
            </div>
        </div>
        <div id="guestsTable"></div>
        <div class="row">
            <div class="col-md-4 col-md-offset-8">
                <div class="form-group text-right">
                    <button type="button" class="btn btn-primary btn-block addGuest"><i class="fa fa-plus" aria-hidden="true"></i> <?php pll_e('Add guest');?></button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <input name="email" class="form-control" required type="email" placeholder="<?php pll_e('Your email')?> *"/>
        </div>
        <div class="form-group">
            <input name="phone" class="form-control" required type="tel" placeholder="<?php pll_e('Your phone')?> *"/>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <textarea name="message" class="form-control" rows="6" placeholder="<?php pll_e('Your message')?> *"></textarea>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-lg-12 text-center">
        <div id="formError" class="help-block text-danger"></div>
        <button type="submit" class="btn btn-xl" type="submit"><?php pll_e('Send confirmation')?></button>
    </div>
</div>
</form>
<div id="formSuccess"><h3 class="text-center"></h3></div>

<script id="guestRow" type="text/template">
<div class="row">
    <div class="col-lg-12 hidden-md hidden-lg">
        <h5><?php pll_e('Guest details');?></h5>
    </div>
    <div class="col-md-4">
        <div class="input-group">
            <input name="guest[]" required class="form-control" type="text" placeholder="<?php pll_e('Guest name')?> *">
            <span class="input-group-addon btn btn-danger bs-invalid hidden-md hidden-lg removeGuest" alt="<?php pll_e('Remove guest');?>"><i class="fa fa-times" aria-hidden="true"></i></span>
        </div>
    </div>
    <div class="col-md-4">
        <select name="event[]" class="selectpicker" required>
            <option value=""><?php pll_e('Select events');?></option>
            <option value="reception_brunch"><?php pll_e('Reception & Brunch');?></option>
            <option value="reception"><?php pll_e('Reception');?></option>
            <option value="apologies"><?php pll_e('Apologies, I will not be able to attend');?></option>
        </select>
    </div>
    <div class="col-md-4">
        <div class="input-group">
            <input name="diet[]" class="form-control" type="text" placeholder="<?php pll_e('Special dietary')?>">
            <span class="input-group-addon btn btn-danger bs-invalid hidden-xs hidden-sm removeGuest" alt="<?php pll_e('Remove guest');?>"><i class="fa fa-times" aria-hidden="true"></i></span>
        </div>
    </div>
</div>
</script>

<script type="text/javascript">
(function ($) {
    "use strict"; // Start of use strict

    var guestTable = $('div#guestsTable');
    var $form = $('form#contactForm');

    $('.addGuest').on('click', function(e) {
        guestTable.append($('script#guestRow').html())
            .find('select:last').selectpicker('refresh');
        $form.validator('update');
    });
    $('div#guestsTable').on('click', 'span.removeGuest', function(e) {
        $(this).closest('div.row').remove();
        $form.validator('update');
    });

    $.fn.serializeObject = function() {
        var o = {};
        var a = this.serializeArray();
        $.each(a, function() {
            if (o[this.name] !== undefined) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push(this.value || '');
            } else {
                o[this.name] = this.value || '';
            }
        });
        return o;
    };

    $form.validator().on('submit', function(e) {
        if (e.isDefaultPrevented()) {
            //validation error
        } else {
            event.preventDefault();
            console.log($form.serializeObject());

            $form.find('button').attr('disabled', true);
            $.ajax({
                type: 'POST',
                url: $form.attr('action'),
                data: $form.serialize(),
                success: function(data, text) {
                    $form.slideUp( "slow", function() {
                        $('div#formSuccess').find('h3').html("<?php pll_e('Thank you for confirmation. We are super excited to see you there!')?>");
                    });
                },
                error: function(request, status, error) {
                    $form.find('button').attr('disabled', false);
                    $('div#formError').hide().html("<?php pll_e('An error occured. Please try again.')?>").slideDown().delay(2000).slideUp();
                }
            });
        }
    });

})(jQuery); // End of use strict
</script>
