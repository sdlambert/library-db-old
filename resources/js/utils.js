export function scrollToId(targetId) {
  let targetElement = document.getElementById(targetId);
  if(targetElement) {
    targetElement.scrollIntoView({"behavior": "smooth"});
  } else {
    throw new Error(`Unable to find element with id #${targetId}`);
  }
}