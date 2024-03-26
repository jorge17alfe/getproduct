const deleteRow = (getData, action, deleteItem) => {
    jQuery(document).ready(($) => {
        if (confirm("Are you sure you want to delete it?")) {
            const getid = $(document)[0].activeElement;

            id = $(getid).attr(getData);


            $.post({
                url: PetitionAjax.url,
                data: {
                    action: action,
                    nonce: PetitionAjax.security,
                    data: id
                }
            }).done((response) => {
                // response = response.substring(0, response.length - 1);
                // console.log(response)
                $(deleteItem + id).hide("slow");
                setTimeout(() => $(deleteItem + id).remove(), 500)
            })
        }
    })
}