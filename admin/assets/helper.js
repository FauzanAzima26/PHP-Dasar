const slugify = (text) => {
    return text.trim()
      .toLowerCase()
      .replace(/\s+/g, '-') //Ganti spasi dengan "-"
      .replace(/[^\w-]+/g, '') //Ganti karakter non-alphanumerik
      .replace(/--+/g, '-'); //Ganti beberapa "-" menjadi satu "-"
  }