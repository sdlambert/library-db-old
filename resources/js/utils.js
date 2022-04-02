// https://github.com/GitbookIO/isbn-utils#readme
const isbnUtils = require('isbn-utils');

export function scrollToId(targetId) {
  let targetElement = document.getElementById(targetId);
  if(targetElement) {
    targetElement.scrollIntoView({"behavior": "smooth"});
  } else {
    throw new Error(`Unable to find element with id #${targetId}`);
  }
}

export function isValidIsbnRegEx(value) {
  // https://www.oreilly.com/library/view/regular-expressions-cookbook/9781449327453/ch04s13.html
  // https://regex101.com/r/tsX2xy/1
  return /^(?:ISBN(?:-1[03])?:? )?(?=[0-9X]{10}$|(?=(?:[0-9]+[- ]){3})[- 0-9X]{13}$|97[89][- ]?[0-9]{10}$|(?=(?:[0-9]+[- ]){4})[- 0-9]{17}$)(?:97[89][- ]?)?[0-9]{1,5}[- ]?[0-9]+[- ]?[0-9]+[- ]?[0-9X]$/
    .test(value);
}

export function isbnStringToInt(isbn) {
  if(isbn) {
    // strip optional identifier
    isbn = isbn.replace(/(?:ISBN(?:-1[03])?:? )/, "");
    return isbnUtils.asIsbn10(isbn);
  } else {
    return undefined;
  }
}