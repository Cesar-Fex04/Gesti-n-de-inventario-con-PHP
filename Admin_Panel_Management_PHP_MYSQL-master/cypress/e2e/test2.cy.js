describe('template spec', () => {
  it('passes', () => {
    cy.visit('http://localhost/Admin_Panel_Management_PHP_MYSQL-master/login.php')
    cy.wait(5000)
    cy.get("h3").contains("User login")

  })

  it('Debe permitir al usuario enviar credenciales de login', () => {
    cy.visit('http://localhost/Admin_Panel_Management_PHP_MYSQL-master/login.php')
    cy.wait(2000)
    cy.get('input[name="email"]').type('alex@gmail.com');
    cy.get('input[name="password"]').type('alex662');
    cy.get('button.btn.btn-success').click();
    })


  it('Debe permitir al usuario ver el panel e ingresar a cada', () => {
    cy.get('input[name="email"]').type('alex@gmail.com');
    cy.get('input[name="password"]').type('alex662');
    cy.get('button.btn.btn-success').click();

    })

  });