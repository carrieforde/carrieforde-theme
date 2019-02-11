export function linkColor() {
  const nav = document.getElementById('social-navigation'),
    navLinks = nav.querySelectorAll('a'),
    block = document.querySelector('.has-white-color');

  if (!block) {
    return;
  }

  let blockPosition = block.getBoundingClientRect().bottom;

  for (const link of navLinks) {
    const linkPosition = link.getBoundingClientRect().bottom;

    if (blockPosition > linkPosition) {
      link.style.color = '#fff';
    } else {
      link.style.color = '';
    }
  }
}

export function positionNavigation() {
  const nav = document.getElementById('social-navigation'),
    siteContent = document.querySelector('.site-content'),
    siteContentRightEdge = siteContent.getBoundingClientRect().right;

  if (window.innerWidth < 1050 + 52) {
    nav.style.left = '';
    return null;
  }

  nav.style.left = `${siteContentRightEdge + 32}px`;
}
