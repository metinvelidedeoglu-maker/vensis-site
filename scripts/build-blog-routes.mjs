import { readFile, mkdir, writeFile } from 'node:fs/promises';
const posts = JSON.parse(await readFile('data/blog-posts.json', 'utf8'));
for (const post of posts) {
  const directory = `blog/${post.slug}`;
  await mkdir(directory, { recursive: true });
  await writeFile(`${directory}/index.php`, `<?php\n$slug = ${JSON.stringify(post.slug)};\nrequire dirname(__DIR__).'/post.php';\n`);
}
console.log(`${posts.length} blog adresi oluşturuldu.`);
