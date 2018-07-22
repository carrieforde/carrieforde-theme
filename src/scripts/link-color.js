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
