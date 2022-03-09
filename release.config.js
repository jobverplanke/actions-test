module.exports = {
  branches: ['main'],
  tagFormat: 'v${version}',
  plugins: [
    ["@semantic-release/commit-analyzer", {
      parserOpts: {
        noteKeywords: ["BREAKING CHANGE", "BREAKING CHANGES", "BREAKING"]
      }
    }],
    "@semantic-release/github"
  ]
}
