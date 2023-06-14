for month in range(1, 13):
    start_date = f"2023/{month:02d}/01"
    end_date = f"2023/{month:02d}/30"
    query = f"SELECT SUM(TOTAL) FROM `commande` WHERE date BETWEEN '{start_date}' AND '{end_date}'"
    print(query)
