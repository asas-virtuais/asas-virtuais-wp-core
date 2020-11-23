(function() {
    document.querySelectorAll( 'label[multiple]' ).forEach( e => {
        e.addEventListener( 'click', event => {

            const b = e.querySelector('b')
            const i = e.querySelector('input')

            if ( ! [b, i].includes( event.target ) ) {
                return
            }

            e.querySelectorAll( 'input[type="checkbox"]' ).forEach( c => {
                c.checked = i.checked
            } )

        } )
    } )
})()