const vat = (x) => {
    document.getElementsByName('cash_vat')[0].value = (Number(x.value) + ((Number(x.value) * (5/100)) ))
}
