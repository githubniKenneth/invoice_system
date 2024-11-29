## Local Credentials 
<p>ken@test.com</p>
<p>123456789</p>

# Simple Invoicing System

## Features
- **Login Mechanism**
  - Secure user authentication.
- **Customer Management**
  - Users can **Create, Read, Update, and Delete (CRUD)** customers.
- **Invoice Management**
  - Users can **Create, Read, Update, and Delete (CRUD)** invoices.
  - Each invoice includes:
    - Invoice number
    - Customer
    - Invoice date
    - Line items:
      - Type (Product/Service)
      - Product/Service
      - Quantity
      - Base Price
      - Subtotal
    - Totals:
      - Discount
      - VAT
      - Grand Total
- **Payment Records**
  - Users can create payment records directly linked to invoices.
  - Features include:
    - Multiple payment records for an invoice (partial payments supported).
    - Payment record details:
      - Payment Record Number
      - OR Number
      - Payment Date
      - Amount Paid
      - Type of Payment (credit card, cash, check, direct debit, bank transfer).

## Views and Reports
- View invoices of a specific customer.
- View payment records of a specific customer.
- View the total amount of open invoices for a customer.
- View the total amount of payments made by a customer.

## Admin Dashboard
- Stacked bar graph visualization of paid amounts vs. invoices per month for 1 year.

---

### Example Usage
1. **Create an Invoice**  
   - Add line items such as products or services.
   - Automatically calculate subtotal, discounts, VAT, and grand total.
   
2. **Record Payments**  
   - Add one or multiple payments to an invoice.
   - Track payments using OR numbers and payment types.

3. **View Reports**  
   - Easily view customer balances and payment histories.
   - Analyze payment trends with visual charts.
