$(function() {

    var message = "Aliens doesn't exist"
    function load_messages() {
        $.getJSON("/api/students", alien_messages => {
            if (alien_messages.length > 0) {
                message = `<b>${alien_messages[0].name}</b> says:<br>${alien_messages[0].message}`
            }

            $("#alien").html(message)
        })
    }

    load_messages()
    setInterval(load_messages, 10000)
})