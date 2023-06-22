const puppetter = require('puppeteer');

(async() =>{
    const browser = await puppetter.launch({
        headless: false,
        defaultViewport: false
    });
    const page = await browser.newPage();
    await page.goto('https://consignado.senff.com.br/WebAutorizador/Login/AC.UI.LOGIN.aspx?FISession=ce1722c95fb4');
    //await page.screenshot({ path: 'ases.png'});
    //await browser.close();
    //await page.

    // usuário JOEL.INGUZ
    // senha Credix01*

})();