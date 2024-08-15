function conditionalFiles() {
    const conditional = document.querySelectorAll('.conditional-parent input');
    if (!conditional.length) return;
    conditional.forEach((item) => {
        console.dir(item.checked + ' - ' + item.value);
        let child = item.value;
        let cf = document.querySelector('.cmb-row.'+child+'');
        if (item.checked && cf) {
            cf.style.display = 'block';
        }

        item.addEventListener('change', (e) => {
            if (item.checked && cf) {
                cf.style.display = 'block';
            } else {
                document.querySelector('.cmb-row.'+item.dataset.child+'').style.display = '';
            }
        });
    });
}
conditionalFiles();

function glamping_recommended_list_save() {
    const glampingRecommendedInputs = document.querySelectorAll('input.glamping_recommended_list');
    if (!glampingRecommendedInputs.length) return;
    glampingRecommendedInputs.forEach((input) => {
        input.addEventListener('change', function () {
            let formData = new FormData();
            formData.append('action', 'glamping_meta_update');
            formData.append('post_id', input.dataset.glamp);
            formData.append('post_meta', 'glamping_recommended');
            formData.append('meta_value', input.checked);

            jQuery(document).ready( function($){
                $.ajax({
                    url: ajaxurl,
                    method: 'post',
                    processData: false,
                    contentType: false,
                    data: formData,
                    beforeSend: function () {
                        // resultSuccess.innerHTML = `<p class="color-green fs-20 mt40">${cuccessText}</p>`;
                    },
                    success: function(data){
                        console.dir(data);
                    },
                    error: function (jqXHR, text, error) {
                        console.log('Ошибка отправки.');
                    }
                });
            });
        });
    });
}
glamping_recommended_list_save();

jQuery( function( $ ) {
    function replaceTitlesGen(groupId, titleId) {
        var $box = $( document.getElementById( groupId ) );

        var replaceTitles = function() {
            $box.find( '.cmb-group-title' ).each( function() {
                var $this = $( this );
                var txt = $this.next().find( '[id$="'+titleId+'"]' ).val();
                var rowindex;

                if ( ! txt ) {
                    txt = $box.find( '[data-grouptitle]' ).data( 'grouptitle' );
                    if ( txt ) {
                        rowindex = $this.parents( '[data-iterator]' ).data( 'iterator' );
                        txt = txt.replace( '{#}', ( rowindex + 1 ) );
                    }
                }

                if ( txt ) {
                    $this.text( txt );
                }
            });
        };

        var replaceOnKeyUp = function( evt ) {
            var $this = $( evt.target );
            var id = titleId;

            if ( evt.target.id.indexOf(id, evt.target.id.length - id.length) !== -1 ) {
                $this.parents( '.cmb-row.cmb-repeatable-grouping' ).find( '.cmb-group-title' ).text( $this.val() );
            }
        };

        $box
            .on( 'cmb2_add_row cmb2_remove_row cmb2_shift_rows_complete', replaceTitles )
            .on( 'keyup', replaceOnKeyUp );

        replaceTitles();
    }
    replaceTitlesGen('accommodation_options', 'title');
    replaceTitlesGen('glamping_paid_options', 'title');
});

function conditionalFilesPaidOptions() {
    const cmbAddGroupBtn = document.querySelector('button.cmb-add-group-row');
    if (!cmbAddGroupBtn) return;
    console.dir(glamping_club_admin);
    console.dir(glamping_club_admin.glOptions.glamping_facilities_general);

    let selects = document.querySelectorAll('select');

    cmbAddGroupBtn.addEventListener('click', (e) => {
        setTimeout(function(){
            let selectsN = document.querySelectorAll('select');
            console.dir(selectsN);
            selectsN.forEach((select) => {
                select.addEventListener('change', (e) => {
                    console.log("Changed to: " + e.target.value)
                });
            });
        }, 400);
    });
}
// conditionalFilesPaidOptions();

function multicheckRequired() {
    const fieldGroupRequired = document.querySelectorAll('.multicheck-required');
    if (!fieldGroupRequired) return;
    const form = document.getElementById( 'post' );
    if (!form) return;
    form.addEventListener('submit', (e) => {
        console.dir(fieldGroupRequired);
        fieldGroupRequired.forEach((item) => {
            let inputs = item.querySelectorAll('input');
            console.dir(inputs);
            let cr = 0;
            inputs.forEach((input) => {
                if (input.checked == true) {
                    console.dir(input.checked);
                    cr++;
                }
            });
            console.dir(cr);
            let wr = item.children[1].children[2];
            console.dir(item.children[1].children[2]);
            if (cr) {
                console.dir('Yes');
                wr.classList.remove('active');
                item.style.background = '';
            } else {
                e.preventDefault();
                wr.classList.add('active');
                item.style.background = '#ffefef';
            }
        });
    });
}
multicheckRequired();

jQuery(document).ready(function($) {

    $form = $( document.getElementById( 'post' ) );
    $htmlbody = $( 'html, body' );
    $toValidate = $( '[data-validation]' );

    if ( ! $toValidate.length ) {
        return;
    }

    function checkValidation( evt ) {
        var labels = [];
        var $first_error_row = null;
        var $row = null;

        function add_required( $row ) {
            $row.css({ 'background-color': 'rgb(255, 170, 170)' });
            $first_error_row = $first_error_row ? $first_error_row : $row;
            labels.push( $row.find( '.cmb-th label' ).text() );
        }

        function remove_required( $row ) {
            $row.css({ background: '' });
        }

        $toValidate.each( function() {
            var $this = $(this);
            var val = $this.val();
            $row = $this.parents( '.cmb-row' );

            if ( $this.is( '[type="button"]' ) || $this.is( '.cmb2-upload-file-id' ) ) {
                return true;
            }

            if ( 'required' === $this.data( 'validation' ) ) {
                if ( $row.is( '.cmb-type-file-list' ) ) {

                    var has_LIs = $row.find( 'ul.cmb-attach-list li' ).length > 0;

                    if ( ! has_LIs ) {
                        add_required( $row );
                    } else {
                        remove_required( $row );
                    }

                } else {
                    if ( ! val ) {
                        add_required( $row );
                    } else {
                        remove_required( $row );
                    }
                }
            }

        });

        if ( $first_error_row ) {
            evt.preventDefault();
            // alert( 'The following fields are required and highlighted below:' + labels.join( ', ' ) );
            $htmlbody.animate({
                scrollTop: ( $first_error_row.offset().top - 200 )
            }, 1000);
        } else {
            // Feel free to comment this out or remove
            alert( 'submission is good!' );
        }

    }

    // $form.on( 'submit', checkValidation );
});
