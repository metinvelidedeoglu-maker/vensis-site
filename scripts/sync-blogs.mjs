import { createHash } from 'node:crypto';
import { mkdir, writeFile } from 'node:fs/promises';

const sites = [
  ['Vitlo', 'https://vitlofan.com.tr'],
  ['Vortice', 'https://vorticefan.com.tr'],
  ['Elicent', 'https://elicentfan.com.tr'],
  ['Exproof Fan', 'https://exprooffan.com.tr'],
  ['Exproof Elektrik', 'https://exproofelektrik.com.tr'],
  ['Vensis Elektrik', 'https://vensiselektrik.com.tr'],
];

const stripText = (html = '') => html
  .replace(/<script[\s\S]*?<\/script>/gi, ' ')
  .replace(/<style[\s\S]*?<\/style>/gi, ' ')
  .replace(/<[^>]*>/g, ' ')
  .replace(/&nbsp;|&#160;/gi, ' ')
  .replace(/&hellip;|&#8230;/gi, '…')
  .replace(/&amp;/gi, '&')
  .replace(/&quot;|&#8220;|&#8221;/gi, '"')
  .replace(/&#8217;|&rsquo;/gi, '’')
  .replace(/\s+/g, ' ')
  .trim();

const sanitizeHtml = (html = '') => html
  .replace(/<script[\s\S]*?<\/script>/gi, '')
  .replace(/<style[\s\S]*?<\/style>/gi, '')
  .replace(/<!--([\s\S]*?)-->/g, '')
  .replace(/<\/?(?:div|section|article|main|figure|span)[^>]*>/gi, '')
  .replace(/<h1([^>]*)>/gi, '<h2$1>')
  .replace(/<\/h1>/gi, '</h2>')
  .replace(/\s(?:class|id|style|data-[\w-]+|aria-[\w-]+)=(?:"[^"]*"|'[^']*')/gi, '')
  .replace(/<a\s+([^>]*?)>/gi, (match, attrs) => {
    const href = attrs.match(/href=(?:"([^"]*)"|'([^']*)')/i);
    return href ? `<a href="${href[1] || href[2]}" target="_blank" rel="noopener">` : '';
  })
  .replace(/<\/?(?!p\b|h2\b|h3\b|h4\b|ul\b|ol\b|li\b|table\b|thead\b|tbody\b|tr\b|th\b|td\b|blockquote\b|hr\b|strong\b|em\b|a\b|br\b)[a-z][^>]*>/gi, '')
  .replace(/\n{3,}/g, '\n\n')
  .trim();

const categoryFor = (title) => {
  const value = title.toLocaleLowerCase('tr');
  if (value.includes('vortice')) return 'Vortice';
  if (value.includes('exproof') || value.includes('atex')) return 'Ex-Proof';
  if (value.includes('otopark') || value.includes('havalandırma sistemi')) return 'Havalandırma';
  return 'Fan Teknolojileri';
};

const slugFixes = new Map([
  ['https-vitlofan-com-tr-contact', 'havalandirmada-kullanilan-fan-cesitleri'],
  ['exproof-fan-secim-rehberi-dogru-fani-nasil-belirleriz-2', 'vortice-fanlar-neden-tercih-edilir'],
]);

const fetched = await Promise.all(sites.map(async ([name, base]) => {
  const response = await fetch(`${base}/wp-json/wp/v2/posts?per_page=100&_embed=1`);
  if (!response.ok) throw new Error(`${name}: ${response.status}`);
  return { name, base, posts: await response.json() };
}));

const unique = new Map();
for (const site of fetched) {
  for (const post of site.posts) {
    const contentText = stripText(post.content?.rendered || '');
    const hash = createHash('sha256').update(contentText.toLocaleLowerCase('tr')).digest('hex');
    if (unique.has(hash)) {
      unique.get(hash).sources.push({ name: site.name, url: post.link });
      continue;
    }
    const title = stripText(post.title?.rendered || '');
    const words = contentText.split(/\s+/).filter(Boolean).length;
    let excerptText = contentText;
    while (excerptText.toLocaleLowerCase('tr').startsWith(title.toLocaleLowerCase('tr'))) {
      excerptText = excerptText.slice(title.length).trim();
    }
    unique.set(hash, {
      slug: slugFixes.get(post.slug) || post.slug,
      title,
      date: post.date.slice(0, 10),
      category: categoryFor(title),
      excerpt: excerptText.slice(0, 220).trim() + '…',
      readingMinutes: Math.max(2, Math.ceil(words / 220)),
      content: sanitizeHtml(post.content?.rendered || ''),
      sources: [{ name: site.name, url: post.link }],
    });
  }
}

const posts = [...unique.values()].sort((a, b) => b.date.localeCompare(a.date));
await mkdir('data', { recursive: true });
await writeFile('data/blog-posts.json', JSON.stringify(posts, null, 2) + '\n');
console.log(`${fetched.reduce((sum, item) => sum + item.posts.length, 0)} kayıttan ${posts.length} özgün yazı oluşturuldu.`);
