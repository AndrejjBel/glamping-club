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
});
