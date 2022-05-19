const config = require('./docs/release/config.js')

module.exports = {
  branches: ['main'],
  tagFormat: 'v${version}',
  plugins: [
    ['@semantic-release/commit-analyzer', config.commitAnalyzer],
    ['@semantic-release/release-notes-generator', config.releaseNotesGenerator],
    ['@semantic-release/changelog', config.changelog],
    ['@semantic-release/github', config.github],
    ['@semantic-release/git', config.git],
  ]
}
