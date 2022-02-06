//Taula Categories
function categories() {
    const arrCategoriesJSON = '[ "Musica", "Exposicions", "Teatre" ]';
    return arrCategoriesJSON;
}
//Taula Tags
function tags() {
    const arrTagsJSON = '["rock","pop", "hot", "vip","hip hop", "R&B", "trap", "metal", "classic"]';
    return arrTagsJSON;
}
//3 Taules de GEOGRAFIA (cada una crida a l'altre onChange es veuen per FK, no fa falta NestedArrays en aquest cas)
function CCAA() {
    const arrCCAAJSON = '[ "Illes Balears" ]';
    return arrCCAAJSON;
}
function provincies() {
    const arrProvinciesJSON = '[ "Balears" ]';
    return arrProvinciesJSON;
}
function municipis() {
    const arrMunicipisJSON = '[ "Inca","Palma","Manacor" ]';
    return arrMunicipisJSON;
}