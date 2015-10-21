tbl <- read.table(file.choose(),header=TRUE,sep=",")
population <- tbl["POPESTIMATE2009"]
print(summary(population[-1:-5,]))