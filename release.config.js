module.exports = {
  branches: ["main"],
  tagFormat: "v${version}",
  plugins: [
    ["@semantic-release/commit-analyzer", {
      releaseRules: [
        {"type": "breaking", "release": "major"},
        {"type": "feat", "release": "minor"},
        {"type": "fix", "release": "patch"},
        {"type": "chore", "release": "patch"},
      ],
      parserOpts: {
        noteKeywords: ["BREAKING CHANGE", "BREAKING CHANGES", "BREAKING"]
      }
    }],
    "@semantic-release/github"
  ]
}
