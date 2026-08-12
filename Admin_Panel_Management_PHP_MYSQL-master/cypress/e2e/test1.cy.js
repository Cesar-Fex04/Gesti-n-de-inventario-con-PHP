describe('template spec', () => {
  it('passes', () => {
    cy.visit('http://localhost/Admin_Panel_Management_PHP_MYSQL-master/login.php')
    cy.wait(5000)
    cy.get("h3").contains("User login")

  })

  it('Enviar el formulario con credenciales incorrectas', () => {
    cy.wait(2000)
    cy.visit('http://localhost/Admin_Panel_Management_PHP_MYSQL-master/login.php')
    cy.get('input[name="email"]').type('Wrong user');
    cy.get('input[name="password"]').type('Wrong password');
    cy.get('button.btn.btn-success').click();

    })

  it('Debe permitir al usuario enviar credenciales de login', () => {
    cy.visit('http://localhost/Admin_Panel_Management_PHP_MYSQL-master/login.php')
    cy.wait(2000)
    cy.get('input[name="email"]').type('alex@gmail.com');
    cy.get('input[name="password"]').type('alex662');
    cy.get('button.btn.btn-success').click();
    cy.wait(2000)
    cy.get("h3").contains("User list")
    cy.url().should('include', '/index');
    })

  
  it('Verificar que el select contiene las opciones 10, 25, 50, 100', () => {
    });


  });


