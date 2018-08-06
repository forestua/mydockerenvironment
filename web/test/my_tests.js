
const Nightmare = require('nightmare');
var chai = require('chai');
const nightmare = Nightmare({ show: true })

describe('test duckduckgo search results', () => {
    it('should find the nightmare github link first', function(done) {
      this.timeout('10s')
  
      const nightmare = Nightmare()
      nightmare
        .goto('http://localhost:8000/register')
        .type('input[name="name"]', 'saderf')
        .type('input[name="email"]', 'britov333@gmail.com')
        .type('input[name="password"]', 'test123')
        .type('input[name="password_confirmation"]', 'test123')
        .click('input[type="submit"]')
        .wait('#links .result__a')
        .evaluate(() => document.querySelector('#links .result__a').href)
        .end()
        .then(link => {
          expect(link).to.equal('https://github.com/segmentio/nightmare')
          done()
        })
    })
  })