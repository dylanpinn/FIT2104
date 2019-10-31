generate_single:
	pandoc --from markdown+link_attributes-implicit_figures lectures/lecture-03.md -o pdfs/lectures/lecture-03.pdf
	pandoc --from markdown+link_attributes-implicit_figures lectures/lecture-04.md -o pdfs/lectures/lecture-04.pdf
